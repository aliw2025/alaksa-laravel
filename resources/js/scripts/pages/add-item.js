

$(document).ready(function () {


    // $('#items-table').DataTable();
    console.log($('#items-table'));
    fetchItems();
    $("#btnSave").on("click", function () {
        saveItem();
    });


});


function saveItem(params) {
    
    var name = $("#enterName").val();
       

        var host = window.location.host;
        if (name != "") {
            console.log(name);
            $.ajax({
                url: "item",
                type: "POST",
                data: {
                    name: name,
                },
                cache: false,
                success: function (dataResult) {
                    console.log("added data:" + dataResult);
                    if (dataResult.success) {
                        console.log(dataResult.item);
                        var item = dataResult.item;
                        markup ='<tr> <th scope="row">' +
                            item.id +
                            "</th>" +
                            '<td style="width:33%"><input style = "background-color:white !important" type="text" id="name' +
                            item.id +
                            '" value="' +
                            item.name +
                            '" class="form-control no-border" placeholder="" name="Patient-MRN" readonly></td>' +
                            '<td style="width:33%"><button id="btnEdit'+item.id+'" type="submit" class="btn btn-info" onclick="editName('+item.id+')">Edit</button>'+
                        ' <button style="display: none" id="btnSave'+item.id+'" type="submit" class="btn btn-primary" onclick="updateItem('+item.id+')">Save</button>'+
                        ' <button style="display: none" id="btnCancel'+item.id+'" type="submit" class="btn btn-danger" onclick="cancelEdit('+item.id+')">Cancel</button>'+
                        ' <button style="display: none" id="btnDel'+item.id+'" type="submit" class="btn btn-secondary"onclick="deleteItem('+item.id+')">Delete</button>' +
                            "</tr>";
                        tableBody = $("#tbodya");
                        $("#enterName").val("");
                        tableBody.append(markup);
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

function fetchItems() {
    
    console.log("fetching items");
    $.ajax({
        url: "item/get-items",
        type: "GET",
        success: function (dataResult) {
            console.log(dataResult);
            $("#tbodya").empty();
            var i;
            for (i = 0; i < dataResult.length; ++i) {
                // do something with `substr[i]`
                var item = dataResult[i];
                markup ='<tr> <th scope="row">' +
                            item.id +
                            "</th>" +
                            '<td style="width:33%"><input style = "background-color:white !important" type="text" id="name' +
                            item.id +
                            '" value="' +
                            item.name +
                            '" class="form-control no-border" placeholder="" name="Patient-MRN" readonly></td>' +
                            '<td style="width:33%"><button id="btnEdit'+item.id+'" type="submit" class="btn btn-info" onclick="editName('+item.id+')">Edit</button>'+
                        ' <button style="display: none" id="btnSave'+item.id+'"  type="submit" class="btn btn-primary" onclick="updateItem('+item.id+')">Save</button>'+
                        ' <button style="display: none" id="btnCancel'+item.id+'" type="submit" class="btn btn-danger" onclick="cancelEdit('+item.id+')">Cancel</button>'+
                        ' <button style="display: none" id="btnDel'+item.id+'" type="submit" class="btn btn-secondary"onclick="deleteItem('+item.id+')">Delete</button>' +
                            "</tr>";
                        tableBody = $("#tbodya");
                        // $("#enterName").val("");
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
    var cancelEdit = "#btnCancel" + id;
    $(feildId).attr("readonly", false);
    $(btnEdit).hide();
    $(delBtn).show();
    $(saveBtn).show();
    $(cancelEdit).show();
}

function updateItem(id) {
    
    var feildId = "#name" + id;
    var updatedName = $(feildId).val();
    console.log(updatedName);
    $.ajax({
        url: "item/"+id,
        type: "PUT",
        data:{
            name:updatedName,
        },
        success: function (dataResult) {

            
            console.log("item updated:");
            console.log(dataResult);
            fetchItems();
           
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
    $(feildId).attr("readonly", true);
    $(delBtn).hide();
    $(btnEdit).show();
    $(saveBtn).hide();
    $(cancelEdit).hide();
    fetchItems();
}

function deleteItem(id) {
   
    var feildId = "#name" + id;
    var delBtn = "#btnDel" + id;
    var btnEdit = "#btnEdit" + id;
    var saveBtn = "#btnSave" + id;
    var cancelEdit = "#btnCancel" + id;
    console.log('Deleting');

    $.ajax({
        url: "item/"+id,
        type: "DELETE",
        success: function (dataResult) {
            console.log('item deleted');
            fetchItems();
        },
        error: function (xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            console.log(err);
            alert(err);
        },
    });
   
}
