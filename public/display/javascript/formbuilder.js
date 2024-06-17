/*
 * Scripts permettant de gerer un formulaire de saisie des metadonnees
 * une fois le modele cree
 */

/**
 * Cree le formulaire pour la saisie des informations
 * 
 * @param formdef
 * @returns
 */

function getSchema(formdef, isArray = 0) {
    // récupération du schéma du form
    if (isArray == 1) {
        var schema = {
            "type": "array",
            "properties": {},
            "items": {
                "type": "object",
                "properties": {}
            }
        };
    } else {
        var schema = {
            "type": "object",
            "properties": {}
        };
    }

    var baseProps = function (index, value) {
        var prop = {
            "type": value.type,
            "title": value.name
        };

        if (value.type == "select" || value.type == "radio") {
            prop.enum = value.choiceList;
            if (value.required && prop.enum && prop.enum.length > 0) {
                prop.default = prop.enum[0];
                prop.emptySelectFirst = true;
            }
        }
        if (value.type == "checkbox") {
            prop.type = "array";
            prop.items = {};
            prop.items.enum = value.choiceList;
        }

        if (value.required) {
            prop.required = value.required;
        }

        return prop;
    };

    $.each(formdef, function (index, value) {
        var prop = baseProps(index, value);
        //console.log(value.name);
        if (isArray == 1) {
            schema.items.properties[value.name] = prop;
        } else {
            schema.properties[value.name] = prop;
        }
        // console.log(schema.items.properties[value.name]);
    });
    return schema;
}

// ===========================================================//
// récupération des options du form
var baseFields = function (index, value, isArray = 0) {
    var field = {
        "type": value.type
    };

    /*if(value.type != "checkbox" && value.type != "radio"){
        field.label = value.name;
    }*/
    if (isArray == 0) {
        field.label = value.name;
    } else {
        field.label = "";
    }

    if (value.type == "string") {
        field.type = "text";
    }

    if (value.type == "string" || value.type == "number" || value.type == "textarea") {
        field.placeholder = value.measureUnit;
    }


    if (value.choiceList) {
        field.optionLabels = $.map(value.choiceList, function (v, i) {
            return v.text;
        });
        field.sort = function (a, b) {
            return 0;
        }
        field.removeDefaultNone = false;

    }
    if (value.type == "radio") {
        field.removeDefaultNone = true;
    }

    /*if (value.type == "checkbox"||value.type == "radio"){
        field.rightLabel = value.name;
    }*/
    if (value.type == "checkbox") {
        field.type = "checkbox";
    }

    if (value.helperChoice) {
        field.helper = value.helper;
    }
    return field;
};

function getOptions(formdef, isArray = 0) {
    if (isArray == 1) {
        var options = {
            "type": "table",
            "fields": {},
            "datatables": {
                "ordering": false,
                "info": false,
                "paging": false,
                "searching": false
            }
        };
    } else {
        var options = {
            "fields": {}
        };
    }
    $.each(formdef, function (index, value) {
        var field = baseFields(index, value);
        options.fields[value.name] = field;
    });
    return options;
}

// ===========================================================//
// construction du formulaire
function showForm(value, data = "", isArray = 0, readOnly = 0) {

    var schema = getSchema(value, isArray);
    var options = getOptions(value, isArray);
    /*console.log("schema");
    console.log(schema);
    console.log("options");
    console.log(options);*/
    var config = {
        "data": data,
        "schema": schema,
        "options": options,
        //"view": "bootstrap-edit-horizontal"
    }
    var viewParm = "bootstrap";
    if (readOnly == 1) {
        viewParm += "-display";
    } else {
        viewParm += "-edit";
    }
    if (isArray != 1) {
        viewParm += "-horizontal";
    }
    config["view"] = viewParm;
    var exists = $("#metadata").alpaca("exists");
    if (exists) {
        $("#metadata").alpaca("destroy");
    }
    $("#metadata").alpaca(config);
    console.log(config);
}