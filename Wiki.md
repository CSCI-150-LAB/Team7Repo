# Software Specification Page 
 
## 1. Introduction

### 1.1 Purpose
Feedback Loop is a progressive web application that enables feedback communication between instructors and students. Every semester, a new group of students are enrolled in an instructor’s class. Certain teaching styles become incompatible with a student's preferred learning style which causes the student to lack the ability of comprehending the course material. Feedback Loop provides a communication bridge which helps both students and instructors determine the best learning environment. 

### 1.2 Scope
Feedback Loop will be available to all devices. Both the students and instructors will have a profile and dashboard. In a student account students will choose their preferred learning style-reading/writing, visual, audio, and kinesthetic. Students will have the option of being anonymous or public when providing feedback towards an instructor. Instructors will be able to initiate a feedback session for each of their enrolled classes as well as for each class activity. Instructors will also have a profile with information and review from previous students that current or future students can view. Feedback Loop will also have an administrator account which will be able to manage all profiles within the application. 

### 1.3 Overview
The wiki documentation will address each section of the project and will further explain in detail all the specifications, requirements, components, deliverable dates, and how the system works as a whole. 

## 2. Product

### 2.1 Components

#### 2.1.1 Client
	

#### 2.1.2 Server
	

#### 2.1.3 Database
The database is a core part of the application. Information on user accounts -- logins, names, preferred learning styles -- are stored. Also in the database are tables on instructor classes, student enrollment, ratings/reviews of instructor performance, and feedback on conducted activities. This component interacts with the server to present and extract data to and from the client.

Example User Table:
| **id** | **email**    | **first_name** | **last_name** | **password** | **activation** | **type**   | **updated_at** | **created_at** |
|--------|--------------|----------------|---------------|--------------|----------------|------------|----------------|----------------|
| 1234   | jd@gmail.com | Jane           | Doe           | t3st         | NULL           | student    | 2020-10-15     | 2020-9-15      |
| 5678   | js@gmail.com | John           | Smith         | p@ss         | NULL           | instructor | 2020-10-17     | 2020-9-30      |
| 9101   | bs@gmail.com | Bob            | Saget         | w0rd         | NULL           | admin      | 2020-10-20     | 2020-10-18     |

Example Student Profile Table:

| **id** | **major**               | **learning_style** |
|--------|-------------------------|--------------------|
| 1234   | Computer Engineering    | Visual             |
| 2345   | Computer Science        | Auditory           |
| 3456   | Construction Management | Read/Write         |

Example Instructor Profile Table:

| **id** | **department** | **preferred_title** | **visual_style** | **auditory_style** | **read_write_style** | **kinesthetic_style** | **rating** |
|--------|----------------|---------------------|------------------|--------------------|----------------------|-----------------------|------------|
| 5678   | ECE            | Dr.                 | somewhat         | minimal            | primarily            | not at all            | 4.3        |
| 6789   | CSCI           | Mrs.                | not at all       | primarily          | primarily            | somewhat              | 4.2        |
| 1011   | CM             | Professor           | primarily        | somewhat           | somewhat             | not at all            | 2.5        |

Example Instructor Classes Table:

| **class_id** | **instructor_id** | **class_title** | **class_description**  | **start_time** | **end_time** | **monday** | **tuesday** | **wednesday** | **thursday** | **friday** | **saturday** | **sunday** |
|--------------|-------------------|-----------------|------------------------|----------------|--------------|------------|-------------|---------------|--------------|------------|--------------|------------|
| 1            | 5678              | ECE 124         | Signals and Systems    | 12:00:00       | 13:50:00     | NULL       | 1           | NULL          | 1            | NULL       | NULL         | NULL       |
| 2            | 6789              | CSCI 41         | Algorithms             | 9:00:00        | 9:50:00      | 1          | NULL        | 1             | NULL         | 1          | NULL         | NULL       |
| 3            | 1011              | CM 20           | Construction Documents | 15:00:00       | 16:30:00     | NULL       | 1           | NULL          | 1            | NULL       | NULL         | NULL       |

Example Classes Table:

| **class_id** | **student_id** |
|--------------|----------------|
| 1            | 1234           |
| 1            | 2345           |
| 2            | 1234           |

Example Instructor Ratings Table:

| **rating_id** | **rating** | **recommendation**                                                                                                             | **anon** | **authord_id** | **instructor_id** |
|---------------|------------|--------------------------------------------------------------------------------------------------------------------------------|----------|----------------|-------------------|
| 1             | 4          | Wonderful at explaining the course material. The homework is fairly reflective of the exam content.                            | yes      | 0              | 6789              |
| 2             | 5          | Hard professor because of weekly quizzes but if you study properly and attend office hours, you will be able to ace the class. | no       | 1234           | 5678              |
| 3             | 2          | Not very helpful when answering questions in class.                                                                            | yes      | 0              | 1011              |



### 2.2 Users
This application has three types of users: student, instructor, and administrator.  If a user is not logged in, they still have the ability to search for instructors using a search bar (as do any of the users that are logged in).  They also have the ability to click the login/register link and either login or register. 

#### 2.2.1 Student
Students have a user profile which they are able to edit and a user dashboard that displays their schedule and includes links to the professor’s profile for each class.  Students have the ability to leave feedback for a professor for in a feedback session, or a general feedback on the instructor’s profile.

#### 2.2.2 Instructor
Instructors also have a user profile which they are able to edit and a user dashboard.  The instructor user dashboard displays their schedule of classes, as well as a button that allows them to add a new class or section.  The classes on the instructor’s dashboard all have links to a summary page for that specific class as well as all of the students enrolled in the class.  Each student’s name is also a link to that student’s profile for the instructor to view.  On the class view page, instructors also have the option to initiate a feedback session, or add a student to the class.

#### 2.2.3 Admin
Admin users have the same functionality as instructor users with some additional functionalities.  Admins have the ability to moderate any other user’s profile, and the ability to edit feedback given to instructors.  Admins are also able to search for instructors and to sort instructors by their overall rating from students.

## 3. Requirements
### 3.1 UI Requirements
1. UIR1: Main Page  
    - Description: The homepage of the website that includes a description of what the website is for.
    - Reasoning: So the user can access other contents and see the UI.
    - Dependencies: None  
2. UIR2: Login/Register/Recover Password Pages
    - Description: Once the user has clicked on the Login/Register link, the user can login with their username/password, or go to pages to register for an account, or recover a forgotten password.
    - Reasoning: So the user can use the functionalities of a Student/Instructor/Admin.
    - Dependencies: UIR1
3. UIR3: User Profile Creation Page
    - Description: Once the user has created their account, they will create a profile with their preferred learning style and major for Students, or amount of learning style usage, preferred title, and department for Instructors/Admins.
    - Reasoning: So the user can create a profile of preferred learning styles for others to view.
    - Dependencies: UIR2
4. UIR4: User Profile
    - Description:
    - Reasoning: So users can view other users’ profiles, anyone can view Instructor/Admin profiles, only Instructors/Admins can view Student profiles.
    - Dependencies: UIR3
5. UIR4: Edit Profile Page
    -Description: Once the user is logged in and has already created a profile, on their user profile page, there will be a button to edit their profile.
    -Reasoning: So the user can edit their profile.
    Dependencies: UIR5
6. UIR6: User Dashboard
    - Description: Once a user is logged in, they can access their user dashboard and view classes they are enrolled in for Students, and classes they are in charge of and an Add Class/Section button for Instructors/Admins.
    - Reasoning: So users can view their classes in a schedule, Students can access their professor’s file, and Instructors/Admins can view and edit classes and access student profiles.
    - Dependencies: UIR2
7. UIR7: Add Class Page
    - Description: Once an Instructor/Admin is on their dashboard a button that says Add Class/Section can be clicked that takes the user to a page that allows them to add a class number, a description, the days of the week they meet, and times for the class.
    - Reasoning: So that Instructors/Admins can create new classes or sections.
    - Dependencies: UIR6
8. UIR8: Class View
    - Description: Once a class is added, on an Instructor/Admin dashboard, a link for each class is provided that bring them to this page which has the class information as well as a button to add students, and a list of the students.
    - Reasoning: So that Instructors/Admins can view information about the class and students in the class and their profiles.
    - Dependencies: UIR6, UIR7
9. UIR9: Add Student(s) Page
    - Description: Once the button on the class view page labeled add student is clicked, the professor can add a student by their email address.
    - Reasoning: So that Instructors/Admins can add students to a class, and Students can be added to a class.
    - Dependencies: UIR8
10. UIR10: Search Instructors
    - Description: Once the user selects the Instructor Search in the navigation bar, they can type in an instructor's email, first name, last name, full name, department, and any class titles they are associated with and return any relvant instructor's information.
    - Reasoning: So that users can view information on their current or potential Instructors/Admins.
    - Dependencies: UIR4
11. UIR11: Start Feedback Session Page
    - Description: Once the user is on the Instructor/Admin class view page, they can click the button and create a feedback session by inserting a prompt, and a time frame for the session.
    - Reasoning: So that Instructors/Admins can initiate Feedback Sessions to receive feedback as class is taught and improve the learning environment.
    - Dependencies: UIR8
12. UIR12: Add Feedback in Feedback Session Page
    - Description: Once the user is on the Student dashboard, they can view the feedback sessions for each class, and add feedback for each class.
    - Reasoning: So that Students can add feedback as class is taught and improve the learning environment.
    - Dependencies: UIR6
13. UIR13: Instructor/Admin Feedback Page
    - Description: Once the view feedback button is pressed on the Instructor/Admin profile, a list of all feedback or reviews or ratings are shown.
    - Reasoning: So that users can view feedback and ratings given to the Instructor/Admin.
    - Dependencies: UIR4
14. UIR14: Add Feedback to a Instructor/Admin Profile
    - Description: As a student on an Instructor/Admin profile, a button add feedback can be pressed to take to this page that prompts the student to input a rating, any textual feedback, and whether or not they want to be anonymous for the feedback.
    - Reasoning: So that users can add feedback and ratings to the Instructor/Admin.
    - Dependencies: UIR13

### 3.2 Functional Requirements
1. FR1: User Registration
    - Description: The user will register as an administrator, instructor, or student and create login information to access the site later on.  The user must provide their first name, last name, email, the account type (Student/Instructor/Admin), and a password.
    - Reasoning: In order for the user to have an account in the system.
    - Dependencies: None
2. FR2: Login
    - Description: The user will input their email and password for their account and it will check the information with the database, if it is correct it will log the user in, if not it will prompt them to try again.
    - Reasoning: In order for the user to access their account and the relevant information.
    - Dependencies: FR1
3. FR3: Create/Edit Instructor Profile
    - Description: If the user is an instructor, they can put information for their profile such as their preferred title (Professor, Dr., Mr., Mrs., or Ms.), their department as text, and how much they use each learning style (primarily, somehwat, minimal, or not at all for visual, auditory, reading/writing, and kinesthetic learning styles).  If they have already created a profile, they can go back to it and edit it at another time.
    - Reasoning: So instructors can give some information about themselves to other users.
    - Dependencies: FR2
4. FR4: View Instructor Profile
    - Description: Any user can view information from an instructor's profile that was posted from the create/edit profile.
    - Reasoning: So users can see instructor's profile information and get a general idea of the instructor.
    - Dependencies: FR3
100000. FR_: Student Dashboard
    - Description: The student user will be able to view all of the classes they are enrolled in and may visit their instructor's profile page or their class page upon clicking each respective item in the schedule.
    - Reasoning: In order for the student to see which classes they are enrolled in.
    - Dependencies: Instructor Profile, Instructor Classes
100001. FR_: Add Review
    - Description: The student user is able to add these reviews to professors' pages: ratings (out of 5 stars), recommendations (textual review of their class experiences with the instructor). The user may remain anonymous in these reviews if they wish.
    - Reasoning: In order for other students to understand the professor's teaching style/class experience.
    - Dependencies: Instructor Profile

### 3.3 Non-Functional Requirements

## 4. Prioritization

### 4.1 Timeline

## 5. Diagrams

```
FeedbackLoop by Null Entity  
Daniel Flynn & Sumanjit Gill & Karla Moreno & Kamarin San Nicolas & Robert Wong  
Fresno State CSCI 150
```
