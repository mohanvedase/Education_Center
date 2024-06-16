var FiltersEnabled = 0; // if your not going to use transitions or filters in any of the tips set this to 0
var spacer="&nbsp; &nbsp; &nbsp; ";

// email notifications to admin
notifyAdminNewMembers0Tip=["", spacer+"No email notifications to admin."];
notifyAdminNewMembers1Tip=["", spacer+"Notify admin only when a new member is waiting for approval."];
notifyAdminNewMembers2Tip=["", spacer+"Notify admin for all new sign-ups."];

// visitorSignup
visitorSignup0Tip=["", spacer+"If this option is selected, visitors will not be able to join this group unless the admin manually moves them to this group from the admin area."];
visitorSignup1Tip=["", spacer+"If this option is selected, visitors can join this group but will not be able to sign in unless the admin approves them from the admin area."];
visitorSignup2Tip=["", spacer+"If this option is selected, visitors can join this group and will be able to sign in instantly with no need for admin approval."];

// courses table
courses_addTip=["",spacer+"This option allows all members of the group to add records to the 'Courses' table. A member who adds a record to the table becomes the 'owner' of that record."];

courses_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Courses' table."];
courses_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Courses' table."];
courses_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Courses' table."];
courses_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Courses' table."];

courses_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Courses' table."];
courses_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Courses' table."];
courses_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Courses' table."];
courses_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Courses' table, regardless of their owner."];

courses_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Courses' table."];
courses_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Courses' table."];
courses_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Courses' table."];
courses_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Courses' table."];

// enrollment table
enrollment_addTip=["",spacer+"This option allows all members of the group to add records to the 'Student Enrollments' table. A member who adds a record to the table becomes the 'owner' of that record."];

enrollment_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Student Enrollments' table."];
enrollment_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Student Enrollments' table."];
enrollment_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Student Enrollments' table."];
enrollment_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Student Enrollments' table."];

enrollment_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Student Enrollments' table."];
enrollment_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Student Enrollments' table."];
enrollment_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Student Enrollments' table."];
enrollment_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Student Enrollments' table, regardless of their owner."];

enrollment_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Student Enrollments' table."];
enrollment_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Student Enrollments' table."];
enrollment_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Student Enrollments' table."];
enrollment_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Student Enrollments' table."];

// attendance table
attendance_addTip=["",spacer+"This option allows all members of the group to add records to the 'Attendance' table. A member who adds a record to the table becomes the 'owner' of that record."];

attendance_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Attendance' table."];
attendance_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Attendance' table."];
attendance_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Attendance' table."];
attendance_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Attendance' table."];

attendance_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Attendance' table."];
attendance_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Attendance' table."];
attendance_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Attendance' table."];
attendance_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Attendance' table, regardless of their owner."];

attendance_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Attendance' table."];
attendance_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Attendance' table."];
attendance_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Attendance' table."];
attendance_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Attendance' table."];

// students table
students_addTip=["",spacer+"This option allows all members of the group to add records to the 'Students Data' table. A member who adds a record to the table becomes the 'owner' of that record."];

students_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Students Data' table."];
students_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Students Data' table."];
students_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Students Data' table."];
students_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Students Data' table."];

students_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Students Data' table."];
students_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Students Data' table."];
students_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Students Data' table."];
students_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Students Data' table, regardless of their owner."];

students_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Students Data' table."];
students_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Students Data' table."];
students_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Students Data' table."];
students_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Students Data' table."];

// instructors table
instructors_addTip=["",spacer+"This option allows all members of the group to add records to the 'Instructors Data' table. A member who adds a record to the table becomes the 'owner' of that record."];

instructors_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Instructors Data' table."];
instructors_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Instructors Data' table."];
instructors_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Instructors Data' table."];
instructors_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Instructors Data' table."];

instructors_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Instructors Data' table."];
instructors_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Instructors Data' table."];
instructors_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Instructors Data' table."];
instructors_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Instructors Data' table, regardless of their owner."];

instructors_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Instructors Data' table."];
instructors_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Instructors Data' table."];
instructors_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Instructors Data' table."];
instructors_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Instructors Data' table."];

// labs table
labs_addTip=["",spacer+"This option allows all members of the group to add records to the 'Labs' table. A member who adds a record to the table becomes the 'owner' of that record."];

labs_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Labs' table."];
labs_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Labs' table."];
labs_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Labs' table."];
labs_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Labs' table."];

labs_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Labs' table."];
labs_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Labs' table."];
labs_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Labs' table."];
labs_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Labs' table, regardless of their owner."];

labs_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Labs' table."];
labs_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Labs' table."];
labs_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Labs' table."];
labs_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Labs' table."];

// courses_catalog table
courses_catalog_addTip=["",spacer+"This option allows all members of the group to add records to the 'Courses catalog' table. A member who adds a record to the table becomes the 'owner' of that record."];

courses_catalog_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Courses catalog' table."];
courses_catalog_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Courses catalog' table."];
courses_catalog_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Courses catalog' table."];
courses_catalog_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Courses catalog' table."];

courses_catalog_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Courses catalog' table."];
courses_catalog_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Courses catalog' table."];
courses_catalog_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Courses catalog' table."];
courses_catalog_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Courses catalog' table, regardless of their owner."];

courses_catalog_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Courses catalog' table."];
courses_catalog_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Courses catalog' table."];
courses_catalog_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Courses catalog' table."];
courses_catalog_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Courses catalog' table."];

// companies table
companies_addTip=["",spacer+"This option allows all members of the group to add records to the 'Companies' table. A member who adds a record to the table becomes the 'owner' of that record."];

companies_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Companies' table."];
companies_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Companies' table."];
companies_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Companies' table."];
companies_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Companies' table."];

companies_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Companies' table."];
companies_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Companies' table."];
companies_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Companies' table."];
companies_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Companies' table, regardless of their owner."];

companies_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Companies' table."];
companies_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Companies' table."];
companies_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Companies' table."];
companies_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Companies' table."];

/*
	Style syntax:
	-------------
	[TitleColor,TextColor,TitleBgColor,TextBgColor,TitleBgImag,TextBgImag,TitleTextAlign,
	TextTextAlign,TitleFontFace,TextFontFace, TipPosition, StickyStyle, TitleFontSize,
	TextFontSize, Width, Height, BorderSize, PadTextArea, CoordinateX , CoordinateY,
	TransitionNumber, TransitionDuration, TransparencyLevel ,ShadowType, ShadowColor]

*/

toolTipStyle=["white","#00008B","#000099","#E6E6FA","","images/helpBg.gif","","","","\"Trebuchet MS\", sans-serif","","","","3",400,"",1,2,10,10,51,1,0,"",""];

applyCssFilter();
