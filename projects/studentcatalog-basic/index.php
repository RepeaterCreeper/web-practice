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
    <nav class="purple darken-3">
        <div class="nav-wrapper">
            <a href="#" class="brand-logo"
                style="margin-left: 16px; font-family: 'Roboto'; font-size: 2rem;">Student Information System</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="sass.html"></a></li>
                <li><a class="modal-trigger" href="#aboutModal">About</a></li>
                <li><a href="/projects">View More</a></li>
            </ul>
        </div>
    </nav>

    <div class="row">
        <div class="col l8 offset-l2 hide" data-container-id="newRecord"
            style="align-items: center;justify-content: center;">
            <div class="card" data-card-id="dynamicForm">
                <div class="card-header">
                    <h5 class="card-title" style="margin: 0;padding: 8px;background-color: burlywood;color: white;">
                    </h5>
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
                            <button class="btn waves-effect grey darken-3" onclick="toggleForm('back')"
                                style="width: 100%">Cancel</button>
                        </div>
                        <div class="col s6" style="padding-right: 0;">
                            <button class="btn waves-effect green lighten-3" id="submitAction" style="width: 100%;">Add
                                New Record</button>
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
                                <th>Birthday</th>
                                <th>Course</th>
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
                                <input placeholder="Student #" id="studentNoSearch" data-input-tag="studentNo"
                                    type="text">
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
    <!-- Modal Structure -->
    <div id="aboutModal" class="modal">
        <div class="modal-content">
            <h4>About Project</h4>
            <p>Project #: <b>1</b></p>
            <p>Project Name: <b>Student Information System</b></p>
            <p>Author: <b>Joseph Chua &lt;RepeaterCreeper&gt;</b></p>
            <p>Notes: <pre>There will be many more of this same type, but packed with more features and I guess a better codebase. Though that's still on standby.</pre></p>
            <hr>
            <p>Project Description:</p>
            <p>This project was created as part of the many projects that I will be creating as practice with HTML, CSS, JS and PHP. This is the very first project and it's the most simple as well. The ideas is to practice AJAX along with creating a very simple website that is capable of CRUD. <br><br>If you wish to view more about this project you can check out the GitHub page by pressing the <i>View Source</i> button. There is a <i>README</i> dedicated to explaining the features and installation of this particular project. This will be the same procedure for all upcoming projects that will be creating from here on out.</p>
        </div>
        <div class="modal-footer">
            <a href="https://github.com/RepeaterCreeper/web-practice/tree/master/projects/studentcatalog-basic" target="_blank" class="waves-effect waves-blue btn-flat">View Source</a>
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
        </div>
    </div>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
</body>

</html>