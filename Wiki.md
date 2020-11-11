# Software Specification Page 
 
## 1. Introduction

### 1.1 Purpose
Feedback Loop is a progressive web application that enables feedback communication between instructors and students. Every semester, a new group of students are enrolled in an instructor’s class. Certain teaching styles become incompatible with a student's preferred learning style which causes the student to lack the ability of comprehending the course material. Feedback Loop provides a communication bridge which helps both students and instructors determine the best learning environment. Instructors can use information obtained from FeedbackLoop and students' reviews and feedback to adjust their teaching in ways to help the students. Students can use FeedbackLoop as an anonymous, simpler, or more convenient way to provide address difficulties in understanding.  University administrators can utilize FeedbackLoop as a way to check up on instructors' performance and students' learning needs.

### 1.2 Scope
Feedback Loop will be available to all devices. Both the students and instructors will have a profile and dashboard. In a student account students will choose their preferred learning style-reading/writing, visual, audio, and kinesthetic. Students will have the option of being anonymous or public when providing feedback towards an instructor. Instructors will be able to initiate a feedback session for each of their enrolled classes as well as for each class activity. Instructors will also have a profile with information and review from previous students that current or future students can view. Feedback Loop will also have an administrator account which will be able to manage all profiles within the application. 

### 1.3 Overview
The wiki documentation will address each section of the project and will further explain in detail all the specifications, requirements, components, deliverable dates, and how the system works as a whole. 

## 2. Product

### 2.1 Components

#### 2.1.1 Client
The client is how the users of FeedbackLoop will be interacting with the application. Clients may interact with the server to communicate with the database, e.g., logging in and out of the system. The client may also interact with other clients, e.g., when an instructor user issues a feedback session and student users respond.

#### 2.1.2 Server
The server acts as the middleman between the client and the database. A client's requests will be processed by the server, and information will be retrieved from or stored into the database accordingly. Examples include: a student updating their major on their user profile, or an instructor viewing their performance reviews left by students.

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


| **rating_id** | **rating** | **recommendation**                                                                                                             | **anon** | **authord_id** | **instructor_id** | **take_again** |  **homework** |  **attendance_required** |  **grade** |
|---------------|------------|--------------------------------------------------------------------------------------------------------------------------------|----------|----------------|-------------------|-------------|-------------|-------------|-------------|
| 1             | 4          | Wonderful at explaining the course material. The homework is fairly reflective of the exam content.                            | yes      | 0              | 6789              |    Yes       |    Yes       |    No       |    A       |
| 2             | 5          | Hard professor because of weekly quizzes but if you study properly and attend office hours, you will be able to ace the class. | no       | 1234           | 5678              |    N/A       |    No       |    No       |    B       |
| 3             | 2          | Not very helpful when answering questions in class.                                                                            | yes      | 0              | 1011              |    No        |    Yes       |    Yes       |    N/A      |


### 2.2 Users
This application has three types of users: student, instructor, and administrator.  If a user is not logged in, they still have the ability to search for instructors using a search bar (as do any of the users that are logged in).  They also have the ability to click the login/register link and either login or register. 

#### 2.2.1 Student
Students have a user profile which they are able to edit and a user dashboard that displays their schedule and includes links to the professor’s profile for each class.  Students have the ability to leave feedback for a professor for in a feedback session, or a general feedback on the instructor’s profile.

#### 2.2.2 Instructor
Instructors also have a user profile which they are able to edit and a user dashboard.  The instructor user dashboard displays their schedule of classes, as well as a button that allows them to add a new class or section.  The classes on the instructor’s dashboard all have links to a summary page for that specific class as well as all of the students enrolled in the class.  Each student’s name is also a link to that student’s profile for the instructor to view.  On the class view page, instructors also have the option to initiate a feedback session, or add a student to the class.

#### 2.2.3 Admin
Admin users have the same functionality as instructor users with some additional functionalities. Admins have the ability to moderate any other user’s profile and may search for instructors and sort them based on their overall rating from students. Admin users on a school campus include, but are not limited to: the Dean, university president, HR.

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
    - Description: Once a user profile is created, information from the profiles can be viewed, Students' Profiles include their preferred learning style and their major and can be viewed by Instructors and Admins, whereas Instructors' Profiles include how much they use each learning style, department, and email and can be viewed by all users.
    - Reasoning: So users can view other users’ profiles, anyone can view Instructor/Admin profiles, only Instructors/Admins can view Student profiles.
    - Dependencies: UIR3
5. UIR5: Edit Profile Page
    - Description: Once the user is logged in and has already created a profile, on their user profile page, there will be a button to edit their profile.
    - Reasoning: So the user can edit their profile.
    - Dependencies: UIR4
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
    - Description: Once the button on the class view page labeled add student (or the button with csv) is clicked, the professor can add a student by their email address.
    - Reasoning: So that Instructors/Admins can add students to a class (using csv or individual emails), and Students can be added to a class.
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
3. FR3: Forgot Password
    - Description: The user can input their email for their account if they forgot their password.  The user will then receive an activation code to the input email address in order to reset their password.
    - Reasoning: In order for the user to access their account if they forgot their password and can not log in.
    - Dependencies: FR1
4. FR4: Create/Edit Instructor Profile
    - Description: If the user is an instructor, they can put information for their profile such as their preferred title (Professor, Dr., Mr., Mrs., or Ms.), their department as text, and how much they use each learning style (primarily, somewhat, minimal, or not at all for visual, auditory, reading/writing, and kinesthetic learning styles).  If they have already created a profile, they can go back to it and edit it at another time.
    - Reasoning: So instructors can give some information about themselves to other users.
    - Dependencies: FR2
5. FR5: View Instructor Profile
    - Description: Any user can view information from an instructor's profile that was posted from the create/edit profile.
    - Reasoning: So users can see instructor's profile information and get a general idea of the instructor.
    - Dependencies: FR4
6. FR6: Create/Edit Student Profile
    - Description: If the user is a student, they will be able to enter the following information in their profile: declared major and preferred learning style (visual, audio, read/write, kinesthetic). If the student already has a profile, they may return to edit it at a later time.
    - Reasoning: Students can provide instructors and administrators with useful information about themselves.
    - Dependencies: FR2
7. FR7: View Student Profile
    - Description: A student may view their own profile, or an instructor may view a student's profile. 
    - Reasoning: Instructors may view a student's preferred learning style to adjust their activities accordingly. 
    - Dependencies: FR6
8. FR8: Instructor Dashboard
    - Description: The instructor will have a dashboard that lists the classes the instructor is teaching with the number of students enrolled and other details about the classes. 
    - Reasoning: This is the central feature for instructors, as they can interact with all of their classes from this page.
    - Dependencies: FR2
9. FR9: Create Class
    - Description: On the Instructor Dashboard, an instructor is able to create a class with the following details: start time, end time, meeting days, class title, and class description. 
    - Reasoning: The instructor will be able to add the classes they will be teaching in the semester. 
    - Dependencies: FR8
10. FR10: Add Students to Class
    - Description: On every class page, an instructor has the option to add student users to their roster. They can add a single student by using their email address, or many students by uploading a csv file of many student emails.
    - Reasoning: Instructors will be able to enroll and interact with students in their classes for feedback sessions.
    - Dependencies: FR9
11. FR11: Student Dashboard
    - Description: The student user will be able to view all of the classes they are enrolled in and may visit their instructor's profile page upon clicking their instructor's name in the schedule.
    - Reasoning: In order for the student to see which classes they are enrolled in.
    - Dependencies: FR5, FR10
12. FR12: Add Review
    - Description: The student user is able to add these reviews to professors' pages: ratings (out of 5 stars), recommendations (textual review of their class experiences with the instructor). The user may remain anonymous in these reviews if they wish.
    - Reasoning: In order for other students to understand the professor's teaching style/class experience.
    - Dependencies: FR5
13. FR13: Search Instructor
    - Description: Any user can search for a certain instructor from the instructor's email, first name, last name, full name, department, and any class titles they are associated with and return any relvant instructor's information.
    - Reasoning: So users can view information including classes and ratings on any professor they are taking, are going to take, or leave feedback for professors they have already taken.
    - Dependencies: FR5, FR9
14. FR14: Instructors can initiate a Feedback Session
    - Description: A logged in instructor on a class page can set a time and date for a feedback session and when it will end along with the type of question (multiple choice, short answer, etc.) and the question itself.
    - Reasoning: So that instructors can determine when and what specific feedback questions to ask students to improve their teaching.
    - Dependencies: FR9
15. FR15: Students can give Feedback in Feedback Session
    - Description: A student from their dashboard in a class that an instructor has created a feedback session for can leave feedback based on the question and type of question (multiple choice, short answer, etc) that was created.
    - Reasoning: So that students can give feedback to professors on how the current learning environment, teaching style, and their retention are in a class.
    - Dependencies: FR11, FR14
16. FR16: Organize data on Professor Rankings
    - Description: Admins have the ability to look at all instructors' profiles and sort them based on their ratings.
    - Reasoning: So that admins have an easy way to check on instructors' performance and compare them.
    - Dependencies: FR12, FR15
17. FR17: Aggregate Professor Feedback Data
    - Description: All feedback left by students from feedback sessions and ratings, reviews, and comments left by users are all aggregated.
    - Reasoning: So that the professor and some other users can access the professor's performance and ways the professor can improve.
    - Dependencies: FR12, FR15
18. FR18: Students can view Instructor Ratings
    - Description: A student can view the overall ratings of an instructor from the aggregate feedback and reviews.
    - Reasoning: So that users that might take or are currently taking the instructor's class, or users want to check the performance of an instructor, can see the data that demonstrates the instructor's performance.
    - Dependencies: FR17
19. FR19: Admin can manage all profiles
    - Description: Administrators have the ability to censor and moderate feedback and profile pages of both instructors and students.
    - Reasoning: So everything on FeedbackLoop fits with the university's values, and any inappropriate information on profiles or feedback can be removed.
    - Dependencies: FR4, FR6, FR12, FR15

### 3.3 Non-Functional Requirements

1. NFR1: Account Security
    - Description: Passwords for all user accounts will be hashed.
    - Reasoning: To ensure accounts are not breached, passwords would need to be stored securely on the database.

2. NFR2: UI Responsiveness
    - Description: The UI of the application should be prompt, taking no longer than 0.5 seconds to carry out an action.
    - Reasoning: For optimal interaction with the application, the UI must be responsive.

3. NFR3: OS compatibility 
    - Description: All features of the application should be accessible from any browser.
    - Reasoning: Students may have Windows or MacOS devices, so the application must run well on both platforms.

4. NFR4: Screen Size compatibility
    - Description: The display of the application needs to be versatile to adapt to screen sizes of all devices.
    - Reasoning: Students may use their phones or their laptops to access this site, so various screen sizes should be compatible with the display.
    
5. NFR5: User Role Preservation
    - Description: The software will not allow the role of the user (i.e., student, instructor, administrator) to be changed. 
    - Reasoning: This will prevent attackers from attempting to change the role of a user account to elevate their capabilities.

6. NFR6: 

## 4. Prioritization

### 4.1 Timeline

| **Week**            | **Deliverables**                                                                                                                                                          | **Requirement**                                                        |
|---------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------|------------------------------------------------------------------------|
| **1 (9/24/2020)**   | Database Design<br> Registration Page<br> Login Page                                                                                                                      | Unlabeled<br> FR1/UIR2<br> FR2/UIR2                                    |
| **2 (10/1/2020)**   | Student Profile View<br> Student Profile Edit<br> Instructor Profile View<br> Instructor Profile Edit<br> Forgot Password                                                 | FR7/UIR4<br> FR6/UIR3/UIR5<br> FR5/UIR4<br> FR4/UIR3/UIR5<br> FR3/UIR2 |
| **3 (10/8/2020)**   | Student Dashboard<br> Instructor Dashboard<br> Instructor Add Class<br> Instructor view Student Profile from Dashboard<br> Student view Instructor Profile from Dashboard | FR11/UIR6<br> FR8/UIR6<br> FR9/UIR7<br> FR7/UIR4<br> FR5/UIR4          |
| **4 (10/15/2020)**  | Students can add Recommendations/Reviews to Instructor Profile                                                                                                            | FR12/UIR14                                                             |
| **5 (10/22/2020)**  | Instructors can initiate a Feedback Session<br> Students can give Feedback in Feedback Session<br> Search Instructors                                                     | FR14/UIR11<br> FR15/UIR12<br> FR13/UIR10<br>                           |
| **6 (10/29/2020)**  | Organize data on Professor Rankings<br> Aggregate Professor Feedback Data<br> Add Students using CSV                                                                      | FR16<br> FR17<br> FR10/UIR9                                            |
| **7 (11/5/2020)**   | Students can view Instructor Ratings<br> Admin can manage all profiles                                                                                                    | FR18/UIR13<br> FR19                                                    |
| **8 (11/19/2020)**  | Polishing and Perfecting/Documentation                                                                                                                                    | All UI Requirements                                                    |
| **9 (11/19/2020)**  | Polishing and Perfecting/Documentation                                                                                                                                    | All UI Requirements                                                    |
| **10 (11/23/2020)** | Polishing and Perfecting/Documentation                                                                                                                                    | All UI Requirements                                                    |

<br><br>Also see GANTT chart at Schedule.gantt.

## 5. Diagrams

### 5.1 Use Case Diagram
See UseCaseDiagram.drawio for the use case diagram.

### 5.2 Class Diagram

### 5.3 Sequence Diagram

```
FeedbackLoop by Null Entity  
Daniel Flynn & Sumanjit Gill & Karla Moreno & Kamarin San Nicolas & Robert Wong  
Fresno State CSCI 150
```
