Project Overview:
The Attendance System aims to streamline the attendance marking process by leveraging QR code scanning technology. Developed using PHP, MySQL, and Instascan library, this system allows users to mark attendance for students in a specific class and subject.

Features:
Roll Number and Password:
Users are required to enter their roll number and password for authentication.
Class Selection:

Choose the class from a dropdown list (TE_A, TE_B).
Subject Name:

Enter the subject name for which attendance needs to be marked.
QR Code Scanning:

Utilizes Instascan library for QR code scanning.
Displays live video feed from the camera for code scanning.
Mark Attendance:

Validates user credentials against the class database.
Verifies the scanned QR code against the stored QR data.
Location Capture:

Retrieves the user's location using the IP address.
Responsive Design:

Responsive design ensures a consistent user experience across devices.
Technical Details:
Technology Stack:

PHP: Server-side scripting language.
MySQL: Database management system.
Instascan Library: Used for QR code scanning.
JavaScript (jQuery): Enhances user interactions and dynamic content.
Backend Processing:

Validates user credentials against the respective class database.
Verifies the scanned QR code against stored QR data in the 'qrdata' table.
Frontend Design:

Utilizes Bootstrap for a clean and responsive UI.
Custom CSS styles for a visually appealing interface.
Location Retrieval:

Uses the IP-API service to obtain the user's location based on the IP address.
QR Code Scanning Implementation:

Instascan library is embedded to enable real-time QR code scanning.
The video feed displays a preview of the camera, allowing users to scan QR codes.
Security Measures:

Validates user credentials to ensure only authorized users can mark attendance.
QR code verification ensures the authenticity of the scanned code.
Usage:
Authentication:

Enter the roll number and password for user authentication.
Class and Subject Selection:

Choose the class (TE_A, TE_B) and enter the subject name.
QR Code Scanning:

Use the live camera feed to scan the QR code associated with a particular student.
Mark Attendance:

Upon successful authentication and QR code verification, attendance is marked.
Location Capture:

The system captures the user's location using the IP address.
