<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    require_once dirname(__DIR__) . "/process/init.php";

    
    $request = json_decode(file_get_contents("php://input"), true);

    $apiResponse = [];

    if ($request['type']) {
        $type = $request["type"];

        switch ($type) {
            case 'search': // Search for a student no
                $searchString = $request["searchString"];

                $students = $db->query("SELECT * FROM students WHERE student_no LIKE '%$searchString%'");
                //$stmt->bind_param("s", $searchString);

                $apiResponse["data"] = $students->fetch_all();
            break;
            case 'retrieve': // Retrieve single student based on ID
                $id = $request['payload']['id'];
                $student = $db->query("SELECT * FROM students WHERE id = $id");

                $apiResponse["data"] = $student->fetch_all();
            break;
            case 'retrieveAll': // Retrieves all Students and returns JSON
                $students = $db->query("SELECT * FROM students");
                
                $apiResponse['data'] = $students->fetch_all();;
            break;
            case 'delete': // Delete a record given a selected row
                if (!isset($request['payload']['id'])) {
                    $apiResponse["error"] = "Incomplete parameters.";
                } else {
                    $stmt = $db->prepare("DELETE FROM students WHERE id = ?");
                    $stmt->bind_param("i", $request['payload']['id']);

                    $stmt->execute();

                    $apiResponse["status"] = 200;
                    $apiResponse["message"] = "Record has been successfully deleted.";
                }
            break;
            case 'update': // Update a record given a selected row
                if (!isset($request['id'])) {
                    $apiResponse["error"] = "Incomplete parameters.";
                } else {
                    $payload = $request["payload"];

                    $stmt = $db->prepare("UPDATE students SET student_no = ?, firstName = ?, middleInitial = ?, lastName = ?, course = ?, birthday = ?, age = ? WHERE id = ?");
                    $stmt->bind_param("ssssssii", $payload["studentNo"], $payload["firstName"], $payload["middleInitial"], $payload["lastName"], $payload["course"], $payload["DOB"], $payload["age"], $request['id']);
                    $stmt->execute();

                    $apiResponse["status"] = 200;
                    $apiResponse["message"] = "Record has been successfully updated.";
                }
            break;
            case 'insert': // Insert a record
                $payload = $request["payload"];
                $stmt = $db->prepare("INSERT INTO students (student_no, firstName, middleInitial, lastName, course, birthday, age) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssi", $payload["studentNo"], $payload["firstName"], $payload["middleInitial"], $payload["lastName"], $payload["course"], $payload["DOB"], $payload["age"]);
                $stmt->execute();

                $apiResponse["status"] = 200;
                $apiResponse["message"] = "Record has been successfully inserted";
            break;
        }        

        echo json_encode($apiResponse);
    } else {
        $apiResponse["error"] = "Error";
        echo json_encode($apiResponse);
    }