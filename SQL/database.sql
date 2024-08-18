CREATE TABLE Person(
	personID INT AUTO_INCREMENT PRIMARY KEY,
    cccd VARCHAR(12), 
    name VARCHAR(100) NOT NULL,
    birth DATE NOT NULL,
    placeOfbirth VARCHAR(100) NOT NULL,
    normalAddress VARCHAR(100) NOT NULL,
    currentAddress VARCHAR(100) NOT NULL,
    avatar VARCHAR(100),
    phoneNumber VARCHAR(10)
);

CREATE TABLE Account(
	username VARCHAR(100) PRIMARY KEY,
    password VARCHAR(100) NOT NULL,
    type INT DEFAULT(1) NOT NULL
);

CREATE TABLE Admin(
    adminID varchar(16) PRIMARY KEY,
	username VARCHAR(100),
    personID INT
);

CREATE TABLE Teacher(
	teacherID varchar(16) PRIMARY KEY,
    username VARCHAR(100),
    personID INT
);

CREATE TABLE Student(
	studentID varchar(16) PRIMARY KEY,
    username VARCHAR(100),
    course INT,
    personID INT
);

-- Thêm khóa ngoại vào bảng Admin để liên kết với bảng Person
ALTER TABLE Admin
ADD CONSTRAINT FK_Admin_Person
FOREIGN KEY (personID) REFERENCES Person(personID)
ON DELETE SET NULL;

-- Thêm khóa ngoại vào bảng Teacher để liên kết với bảng Person
ALTER TABLE Teacher
ADD CONSTRAINT FK_Teacher_Person
FOREIGN KEY (personID) REFERENCES Person(personID)
ON DELETE SET NULL;

-- Thêm khóa ngoại vào bảng Student để liên kết với bảng Person
ALTER TABLE Student
ADD CONSTRAINT FK_Student_Person
FOREIGN KEY (personID) REFERENCES Person(personID)
ON DELETE SET NULL;

-- Thêm khóa ngoại vào bảng Admin để liên kết với bảng Account
ALTER TABLE Admin
ADD CONSTRAINT FK_Admin_Account
FOREIGN KEY (username) REFERENCES Account(username)
ON DELETE CASCADE;

-- Thêm khóa ngoại vào bảng Teacher để liên kết với bảng Account
ALTER TABLE Teacher
ADD CONSTRAINT FK_Teacher_Account
FOREIGN KEY (username) REFERENCES Account(username)
ON DELETE CASCADE;

-- Thêm khóa ngoại vào bảng Student để liên kết với bảng Account
ALTER TABLE Student
ADD CONSTRAINT FK_Student_Account
FOREIGN KEY (username) REFERENCES Account(username)
ON DELETE CASCADE;



-- Bảng Subject
CREATE TABLE Subject (
    subjectID INT AUTO_INCREMENT PRIMARY KEY,
    subjectName VARCHAR(255) NOT NULL,
    credits INT NOT NULL
);

-- Bảng Class
CREATE TABLE Class (
    classID INT AUTO_INCREMENT PRIMARY KEY,
    subjectID INT,
    teacherID VARCHAR(16),
    className VARCHAR(255) NOT NULL,
    quatity INT,
    status ENUM('pending', 'approved', 'rejected' , 'success') DEFAULT 'pending'
);

-- Bảng SubjectRegis (Đăng ký học)
CREATE TABLE SubjectRegis (
    regisID INT AUTO_INCREMENT PRIMARY KEY,
    studentID VARCHAR(16),
    classID INT,
    status ENUM('pending', 'approved', 'rejected' , 'success') DEFAULT 'pending',
    regisDate DATE NOT NULL
);

-- Bảng ClassList (Danh sách lớp)
CREATE TABLE ClassList (
    classListID INT AUTO_INCREMENT PRIMARY KEY,
    classID INT,
    studentID VARCHAR(16)
);

-- Bảng Score (Điểm số)
CREATE TABLE Score (
    scoreID INT AUTO_INCREMENT PRIMARY KEY,
    classListID INT,
    attendanceScore FLOAT, -- Điểm chuyên cần
    examScore FLOAT,        -- Điểm thi
    finalScore FLOAT,       -- Điểm tổng kết
);

-- Thêm khóa ngoại sau khi tạo bảng
ALTER TABLE Class
ADD CONSTRAINT FK_Class_Subject
FOREIGN KEY (subjectID) REFERENCES Subject(subjectID) ON DELETE CASCADE;

ALTER TABLE Class
ADD CONSTRAINT FK_Class_Teacher
FOREIGN KEY (teacherID) REFERENCES Teacher(teacherID) ON DELETE CASCADE;

ALTER TABLE SubjectRegis
ADD CONSTRAINT FK_SubjectRegis_Student
FOREIGN KEY (studentID) REFERENCES Student(studentID) ON DELETE CASCADE;

ALTER TABLE SubjectRegis
ADD CONSTRAINT FK_SubjectRegis_Class
FOREIGN KEY (classID) REFERENCES Class(classID) ON DELETE CASCADE;

ALTER TABLE ClassList
ADD CONSTRAINT FK_ClassList_Class
FOREIGN KEY (classID) REFERENCES Class(classID) ON DELETE CASCADE;

ALTER TABLE ClassList
ADD CONSTRAINT FK_ClassList_Student
FOREIGN KEY (studentID) REFERENCES Student(studentID) ON DELETE CASCADE;

ALTER TABLE Score
ADD CONSTRAINT FK_Score_ClassList
FOREIGN KEY (classListID) REFERENCES ClassList(classListID) ON DELETE CASCADE;

