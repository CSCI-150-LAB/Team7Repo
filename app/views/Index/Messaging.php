<?php
$currentUser = User::getCurrentUser();

$contacts = [];
if($currentUser->type == "student") {
	$classes = studentClasses::find("studentId =:0:", $currentUser->id);
}
elseif($currentUser->type == "instructor") {
	$classes = InstructorClasses::find("instructorid =:0:", $currentUser->id);
}
if($currentUser->type != "admin") {
	$users = User::find("type =:0:", "admin");
	//There has to be a better way of doing this, but idk yet
	foreach($classes as $class) {
		$people = studentClasses::find("classId = :0:", $class->classId);
		foreach($people as $student) {
			$person = User::getByKey($student->studentId);
			if(!in_array($person,$users)) {
				$users[] = $person;
			}
		}
		$teachers = InstructorClasses::find("classid = :0:", $class->classId);
		foreach($teachers as $teacher) {
			$instructor = User::getByKey($teacher->instructorid);
			if(!in_array($instructor,$users)) {
				$users[] = $instructor;
			}
		}
	}
	$contacts = array_map(function($user) {
		return [
			'id' => $user->id,
			'fullName' => $user->getFullName()
		];
	}, $users);
}
else {
	$contacts = array_map(function($user) {
		return [
			'id' => $user->id,
			'firstName' => $user->firstName,
			'lastName' => $user->lastName,
			'fullName' => $user->getFullName()
		];
	}, User::find());
}

$convos = ChatConversation::query("
SELECT
	*
FROM
	conversations
WHERE
	FIND_IN_SET(:0:,conversations.users)
", $currentUser->id);
$conversations = array_map(function($chatconversation) {
	return [
		'users' => $chatconversation->users
	];
}, $convos);

$this->scriptEnqueue('vuejs', 'https://cdn.jsdelivr.net/npm/vue@2.6.12');
VueLoader::render(APP_ROOT . '/app/vue-components/chat-form.vue', '#messaging-app');
?>

<script>
	var contactList = <?= json_encode($contacts) ?>;
	var conversationList = <?= json_encode($conversations) ?>;
</script>

<div id="messaging-app">
	<chat-form></chat-form>
</div>