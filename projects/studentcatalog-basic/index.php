<html>

<head>
    <title>Student Information System</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        html,
        body {
            height: 100%;
            background-color: #2c3e50;
        }

        .selected-row {
            color: white;
            background-color: #2979FF !important;
        }

        .selected-row td {
            border-radius: 0 !important;
        }

        tbody[data-container='studentList'] tr {
            cursor: pointer;
        }

        .formMode {
            display: flex;
            height: 100%;
            align-items: center;
            overflow: hidden;
            backdrop-filter: brightness(40%);
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="col l8 offset-l2 hide" data-container-id="newRecord" style="align-items: center;justify-content: center;">
            <div class="card" data-card-id="dynamicForm">
                <div class="card-header">
                    <h5 class="card-title" style="margin: 0;padding: 8px;background-color: burlywood;color: white;"></h5>
                </div>
                <div class="card-body" style="padding: 16px;">
                    <div class="row" style="margin: 0;">
                        <form class="col s12">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Student #" id="studentNo" type="text">
                                    <label for="studentNo" class="active">Student No.</label>
                                </div>
                                <div class="input-field col s5">
                                    <input placeholder="First Name" id="firstName" type="text">
                                    <label for="firstName" class="active">First Name</label>
                                </div>
                                <div class="input-field col s2">
                                    <input placeholder="Middle Initial" id="middleInitial" type="text">
                                    <label for="middleInitial" class="active">Middle Initial</label>
                                </div>
                                <div class="input-field col s5">
                                    <input placeholder="Last Name" id="lastName" type="text">
                                    <label for="lastName" class="active">Last Name</label>
                                </div>
                                <div class="input-field col s12">
                                    <input placeholder="DOB" id="DOB" type="text" class="datepicker">
                                    <label for="DOB" class="active">Date of Birth</label>
                                </div>
                                <div class="input-field col s12">
                                    <input placeholder="Course" id="course" type="text">
                                    <label for="course" class="active">Course</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-footer" style="padding: 4px;">
                    <div class="row" style="margin: 0;">
                        <div class="col s6" style="padding-left: 0;">
                            <button class="btn waves-effect grey darken-3" onclick="toggleForm('back')" style="width: 100%">Cancel</button>
                        </div>
                        <div class="col s6" style="padding-right: 0;">
                            <button class="btn waves-effect green lighten-3" id="submitAction" style="width: 100%;">Add New Record</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col l8" data-container-id="studentList">
            <div class="card">
                <div class="card-header purple darken-4" style="padding: 8px;">
                    <h5 class="card-title white-text" style="margin: 0; font-family: 'Arial Black'">Student List</h5>
                </div>
                <div class="card-body">
                    <table class="highlight">
                        <thead>
                            <tr>
                                <th style="display: none;">ID</th>
                                <th>Student #</th>
                                <th>First Name</th>
                                <th>Middle Initial</th>
                                <th>Last Name</th>
                                <th>Course</th>
                                <th>Birthday</th>
                                <th>Age</th>
                            </tr>
                        </thead>

                        <tbody data-container="studentList">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col l4" data-container-id="action">
            <div class="card">
                <div class="card-header purple darken-4" style="padding: 8px;">
                    <h5 class="card-title white-text" style="margin: 0; font-family: 'Arial Black'">Actions</h5>
                </div>
                <div class="card-body" style="padding: 16px;">
                    <div class="row" style="margin: 0;">
                        <div class="col s12" style="margin-bottom: 8px;">
                            <div class="input-field col s12" style="padding: 0; margin: 0;">
                                <input placeholder="Student #" id="studentNoSearch" data-input-tag="studentNo" type="text">
                            </div>
                        </div>
                        <div class="col s12" style="margin-bottom: 8px;">
                            <button class="btn blue-grey darken-2 waves-effect"
                                style="display: flex; width: 100%; justify-content: center;" onclick="search()"><i
                                    class="material-icons">search</i> <span
                                    style="margin-left: 8px;">Search</span></button>
                        </div>
                        <div class="divider" style="height: 1px; border: 1px solid #e8e8e8; margin-bottom: 8px;"></div>
                        <div class="col s12" style="margin-bottom: 8px;">
                            <button class="btn blue waves-effect" onclick="toggleForm('create')" id="newRecordButton"
                                style="display: flex; width: 100%; justify-content: center;"><i
                                    class="material-icons">add</i> <span style="margin-left: 8px;">Add New
                                    Record</span></button>
                        </div>
                        <div class="col s12" style="margin-bottom: 8px;">
                            <button class="btn orange waves-effect" onclick="toggleForm('edit')" id="editRecordButton"
                                style="display: flex; width: 100%; justify-content: center;" disabled=""><i
                                    class="material-icons">edit</i> <span style="margin-left: 8px;">Edit
                                    Record</span></button>
                        </div>
                        <div class="col s12" style="margin-bottom: 8px;">
                            <button class="btn red lighten-2 waves-effect" onclick="deleteRecord()"
                                id="deleteRecordButton" style="display: flex; width: 100%; justify-content: center;"
                                disabled=""><i class="material-icons">delete</i> <span style="margin-left: 8px;">Delete
                                    Record</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript">
        let userID;

        $(document).ready(function(){

            populateTable();
        });

        /**
         * Toggles the Add / Edit form
         */
        function toggleForm(type) {
            /**
             * Change content of the form
             */
            let card = document.querySelector("[data-card-id='dynamicForm']");

            if (document.querySelector("body").style.overflow == "hidden") {
                document.querySelector("body").style.overflow = "";
            } else {
                document.querySelector("body").style.overflow = "hidden";
                if (type == "edit") {
                    $.post({
                        url: "/process/api.php",
                        type: "json",
                        data: JSON.stringify({
                            type: "retrieve",
                            payload: {
                                "id": userID
                            }
                        }),
                        success: function(data) {
                            let fields = document.querySelectorAll("[data-card-id='dynamicForm'] input");

                            for (let i = 0; i < data['data'][0].length - 2; i++) {
                                fields[i].value = data['data'][0][i + 1];
                            }
                        }
                    })
                    card.querySelector(".card-title").innerText = "Edit Record Form";
                    card.querySelector(".card-footer #submitAction").setAttribute("onclick", `editRecord(${userID})`);
                    card.querySelector(".card-footer #submitAction").innerText = "Save Changes";
                } else if (type == "create"){
                    card.querySelector(".card-title").innerText = "New Record Form";
                    card.querySelector(".card-footer #submitAction").setAttribute("onclick", "addNewRecord()");
                    card.querySelector(".card-footer #submitAction").innerText = "Add New Record";
                }
            }
            
            document.querySelector(".row").classList.toggle("formMode");
            const containers = document.querySelectorAll("[data-container-id]");
            
            containers[0].classList.toggle("hide");
            containers[1].classList.toggle("hide");
            containers[2].classList.toggle("hide");

            /**
             * Clear Fields
             */
            document.querySelectorAll("[data-card-id='dynamicForm'] input").forEach((data) => {
                data.value = ""
            });
        }

        /**
         * Add New Record
         */
        function addNewRecord() {
            let fields = {};
            document.querySelectorAll("[data-card-id='dynamicForm'] input").forEach((data) => {
                fields[data.id] = data.value
            });

            fields["DOB"] = convertToStandard(fields["DOB"]);
            age = calculateAge(fields['DOB']);

            $.post({
                url: "./process/api.php",
                dataType: "json",
                data: JSON.stringify({
                    type: 'insert',
                    payload: {
                        ...fields,
                        age: age
                    }
                }),
                success: function(data) {
                    if (data.status == 200) {
                        $("body").css("overflow", "hidden");
                        populateTable();
                        toggleForm();
                    }
                }
            });
        }

        /**
         * Edit Record
         */
        function editRecord(id) {
            let fields = {};
            document.querySelectorAll("[data-card-id='dynamicForm'] input").forEach((data) => {
                fields[data.id] = data.value
            });

            fields["DOB"] = convertToStandard(fields["DOB"]);
            age = calculateAge(fields['DOB']);

            $.post({
                url: "./process/api.php",
                dataType: "json",
                data: JSON.stringify({
                    type: 'update',
                    id: id,
                    payload: {
                        ...fields,
                        age: age
                    }
                }),
                success: function(data) {
                    if (data.status == 200) {
                        userID = null;

                        document.querySelector("#deleteRecordButton").setAttribute("disabled", true);
                        document.querySelector("#editRecordButton").setAttribute("disabled", true);
                        $("body").css("overflow", "hidden");

                        populateTable();
                        toggleForm();
                    }
                }
            });
        }

        /**
         * Fills up the table with initial data.
         */
        function populateTable() {
            $.post({
                url: "./process/api.php",
                dataType: "json",
                data: JSON.stringify({
                    type: "retrieveAll"
                }),
                success: function (data) {
                    let studentListContainer = document.querySelector("*[data-container='studentList']");
                    studentListContainer.innerText = "";

                    for (let student of data['data']) {
                        let tr = document.createElement("tr");

                        let firstCol = true;

                        for (let info of student) {
                            let td = document.createElement("td");
                            td.innerText = info;
                            tr.appendChild(td);

                            if (firstCol) {
                                tr.setAttribute("data-id", info);
                                td.style.display = "none";
                                firstCol = false;
                            }
                        }

                        // Attach event listener to each row
                        tr.addEventListener("click", (e) => rowSelectionHandler(e));

                        studentListContainer.appendChild(tr);
                    }
                }
            });
        }

        /**
         *  Delete Record
         */
        function deleteRecord() {
            $.post({
                url: "./process/api.php",
                dataType: "json",
                data: JSON.stringify({
                    type: "delete",
                    payload: {
                        id: userID
                    }
                }),
                success: function (data) {
                    document.querySelector(`tr[data-id='${userID}']`).remove();

                    id = null;

                    document.querySelector("#deleteRecordButton").setAttribute("disabled", true);
                    document.querySelector("#editRecordButton").setAttribute("disabled", true);
                }
            })
        }

        /**
         * Search
         */
        function search() {
            $.post({
                url: "./process/api.php",
                dataType: "json",
                data: JSON.stringify({
                    type: "search",
                    searchString: document.querySelector("#studentNoSearch").value
                }),
                success: function (data) {
                    let studentListContainer = document.querySelector("*[data-container='studentList']");
                    studentListContainer.innerHTML = "";

                    for (let student of data['data']) {
                        let tr = document.createElement("tr");

                        let firstCol = true;

                        for (let info of student) {
                            let td = document.createElement("td");
                            td.innerText = info;
                            tr.appendChild(td);

                            if (firstCol) {
                                tr.setAttribute("data-id", info);
                                td.style.display = "none";
                                firstCol = false;
                            }
                        }

                        // Attach event listener to each row
                        tr.addEventListener("click", (e) => rowSelectionHandler(e));

                        studentListContainer.appendChild(tr);
                    }
                }
            })
        }

        /**
         * Calculates the age given a DOB.
         */
        function calculateAge(dob) {
            let [year, month, day] = dob.split("-").map((data) => parseInt(data));
            let curDate = new Date();
            let curYear = curDate.getFullYear(),
                curMonth = curDate.getMonth() + 1,
                curDay = curDate.getDate();

            let age = curYear - year;
            
            if (curMonth < month) age -= 1;
            if (curMonth == month && curDay < day) age -= 1;

            return age;
        }

        function convertToStandard(dob) {
            let date = new Date(dob);

            return `${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, "0")}-${date.getDate().toString().padStart(2, "0")}`;
        }

        /**
         * Selection Handler
         */
        function rowSelectionHandler(e) {
            let rowElement = e.path[1];
            // Get id on selection of a row

            if (rowElement.querySelector("td").textContent == userID) {
                rowElement.classList.remove("selected-row");
                userID = null;

                document.querySelector("#deleteRecordButton").setAttribute("disabled", true);
                document.querySelector("#editRecordButton").setAttribute("disabled", true);

                return;
            } else {
                userID = rowElement.querySelector("td").textContent;
            }

            // Remove highlight to currently selected row (if any)
            if (document.querySelector(".selected-row")) {
                document.querySelector(".selected-row").classList.remove("selected-row");
            }

            // Highlight the row;
            rowElement.classList.add("selected-row");

            // Enable Buttons
            document.querySelector("#deleteRecordButton").removeAttribute("disabled");
            document.querySelector("#editRecordButton").removeAttribute("disabled");
        }
    </script>
</body>

</html>