

$(document).ready(function () {

 
    fetchSets();
    $("#btnSaveSet").on("click", function () {
        console.log('saving set');
        saveSet();
    });

});

function saveSet(params) {
    
        var name = $("#enterSetName").val();
       
        if (name != "") {
            console.log(name);
            $.ajax({
                url: "set",
                type: "POST",
                data: {
                    name: name,
                },
                cache: false,
                success: function (dataResult) {
                    console.log("added set:" + dataResult);
                    if (dataResult.success) {
                       
                        var set = dataResult.set;
                        markup ='<tr> <th scope="row">' +
                            set.id +
                            "</th>" +
                            '<td style="width:33%"><input style = "background-color:white !important" type="text" id="name' +
                            set.id +
                            '" value="' +
                            set.name +
                            '" class="form-control no-border" placeholder="" name="Patient-MRN" readonly></td>' +
                            '<td style="width:33%"><button id="btnEdit'+set.id+'" type="submit" class="btn btn-info" onclick="editName('+set.id+')">Edit</button>'+
                        ' <button style="display: none" id="btnSave'+set.id+'" type="submit" class="btn btn-primary" onclick="updateSet('+set.id+')">Save</button>'+
                        ' <button style="display: none" id="btnCancel'+set.id+'" type="submit" class="btn btn-danger" onclick="cancelEdit('+set.id+')">Cancel</button>'+
                        ' <button style="display: none" id="btnDel'+set.id+'" type="submit" class="btn btn-secondary"onclick="deleteSet('+set.id+')">Delete</button>' +
                        ' <button id="btnAdd'+set.id+'" type="submit" class="btn btn-secondary"onclick="addItemToSet('+set.id+')">Add Items</button>' +
                            "</tr>";
                        var tableBody = $("#SetTbody");
                        tableBody.append(markup);
                        $("#enterSetName").val("");
                       
                    } else if (dataResult.statusCode == 201) {

                    }
                },
                error: function (xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err);
                    alert(err);
                },
            });
        } else {
            alert("Please fill all the field !");
        }
}

function fetchSets() {
    
   
    $.ajax({
        url: "set/get-sets",
        type: "GET",
        success: function (dataResult) {
            console.log(dataResult);
            $("#SetTbody").empty();
            var i;
            for (i = 0; i < dataResult.length; ++i) {
                // do something with `substr[i]`
                var set = dataResult[i];
                markup ='<tr> <th scope="row">' +
                set.id +
                "</th>" +
                '<td style="width:33%"><input style = "background-color:white !important" type="text" id="name' +
                set.id +
                '" value="' +
                set.name +
                '" class="form-control no-border" placeholder="" name="Patient-MRN" readonly></td>' +
                '<td style="width:33%"><button id="btnEdit'+set.id+'" type="submit" class="btn btn-info" onclick="editName('+set.id+')">Edit</button>'+
            ' <button style="display: none" id="btnSave'+set.id+'" type="submit" class="btn btn-primary" onclick="updateSet('+set.id+')">Save</button>'+
            ' <button style="display: none" id="btnCancel'+set.id+'" type="submit" class="btn btn-danger" onclick="cancelEdit('+set.id+')">Cancel</button>'+
            ' <button style="display: none" id="btnDel'+set.id+'" type="submit" class="btn btn-secondary"onclick="deleteSet('+set.id+')">Delete</button>' +
            ' <button  id="btnAdd'+set.id+'" type="submit" class="btn btn-secondary"onclick="addItemToSet('+set.id+')">Add Items</button>' +
                "</tr>";
                        var tableBody = $("#SetTbody");
                       
                        tableBody.append(markup);
            }
        },
        error: function (xhr, status, error) {

            var err = eval("(" + xhr.responseText + ")");
            console.log(err);
            alert(err);
        },
    });
}


function editName(id) {
   
    var feildId = "#name" + id;
    var delBtn = "#btnDel" + id;
    var btnEdit = "#btnEdit" + id;
    var saveBtn = "#btnSave" + id;
    var addBtn = "#btnAdd" + id;
    var cancelEdit = "#btnCancel" + id;
    $(feildId).attr("readonly", false);
    $(btnEdit).hide();
    $(addBtn).hide();
    $(delBtn).show();
    $(saveBtn).show();
    $(cancelEdit).show();
}

function updateSet(id) {
    
    var feildId = "#name" + id;
    var updatedName = $(feildId).val();
    console.log(updatedName);
    $.ajax({
        url: "set/"+id,
        type: "PUT",
        data:{
            name:updatedName,
        },
        success: function (dataResult) {

            
            console.log("item updated:");
            console.log(dataResult);
           
        },
        error: function (xhr, status, error) {
           
        },
    });
    
}

function cancelEdit(id) {
   
    var feildId = "#name" + id;
    var delBtn = "#btnDel" + id;
    var btnEdit = "#btnEdit" + id;
    var saveBtn = "#btnSave" + id;
    var cancelEdit = "#btnCancel" + id;
    var addBtn = "#btnAdd" + id;
    $(feildId).attr("readonly", true);
    $(delBtn).hide();
    $(btnEdit).show();
    $(addBtn).show();
    $(saveBtn).hide();
    $(cancelEdit).hide();
    fetchSets();
}

function deleteSet(id) {
   
    var feildId = "#name" + id;
    var delBtn = "#btnDel" + id;
    var btnEdit = "#btnEdit" + id;
    var saveBtn = "#btnSave" + id;
    var cancelEdit = "#btnCancel" + id;
    console.log('Deleting');

    $.ajax({
        url: "set/"+id,
        type: "DELETE",
        success: function (dataResult) {
            console.log('item deleted');
            fetchSets();
        },
        error: function (xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            console.log(err);
            alert(err);
        },
    });
   
}
function addItemToSet(id) {

    window.location.href = "set/create-set/"+id;
}