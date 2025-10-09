<?php

// Fetch system information from the database
function getSystemInfo($conn)
{
    $query = "SELECT * FROM system_info";
    $result = $conn->query($query);
    $data = $result ? $result->fetch_assoc() : [];

    $schoolName = $data['school_name'] ?? 'Al Nadi Ul Falah';
    $schoolAddress = $data['address'] ?? '123 School Lane, City, Country';
    $schoolPhone = $data['phone_no'] ?? '123-456-7890';
    $schoolEmail = $data['email'] ?? 'info@al-nadi-ul-falah.com';
    $schoolLogo = $data['logo'] ?? 'default_logo.png';
    $academicYear = $data['academic_year'] ?? '2024-2025';
    $systemData = [
        'system_name' => $data['system_name'] ?? 'Fee Manager Portal',
        'school_name' => $schoolName,
        'email' => $schoolEmail,
        'phone' => $schoolPhone,
        'address' => $schoolAddress,
        'logo' => $schoolLogo,
        'academic_year' => $academicYear
    ];

    return $systemData;
}
// Fetch the system information
$getSystemInfo = getSystemInfo($conn);