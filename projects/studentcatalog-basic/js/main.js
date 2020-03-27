let userID;

$(document).ready(function () {
    populateTable();
    $('.modal').modal();
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
                success: function (data) {
                    let fields = document.querySelectorAll("[data-card-id='dynamicForm'] input");

                    for (let i = 0; i < data['data'][0].length - 2; i++) {
                        fields[i].value = data['data'][0][i + 1];
                    }
                }
            })
            card.querySelector(".card-title").innerText = "Edit Record Form";
            card.querySelector(".card-footer #submitAction").setAttribute("onclick", `editRecord(${userID})`);
            card.querySelector(".card-footer #submitAction").innerText = "Save Changes";
        } else if (type == "create") {
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
        success: function (data) {
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
        success: function (data) {
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