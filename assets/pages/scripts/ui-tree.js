var base_url = $("#base_url").val();
var UITree = function () {

    var handleSample1 = function () {

        $('#tree_1').jstree({
            "core" : {
                "themes" : {
                    "responsive": false
                }
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder icon-state-warning icon-lg"
                },
                "file" : {
                    "icon" : "fa fa-file icon-state-warning icon-lg"
                }
            },
            "plugins": ["types"]
        });

        // handle link clicks in tree nodes(support target="_blank" as well)
        $('#tree_1').on('select_node.jstree', function(e,data) {
            var link = $('#' + data.selected).find('a');
            if (link.attr("href") != "#" && link.attr("href") != "javascript:;" && link.attr("href") != "") {
                if (link.attr("target") == "_blank") {
                    link.attr("href").target = "_blank";
                }
                document.location.href = link.attr("href");
                return false;
            }
        });
    }

    var handleSample2 = function () {
        var role_id = $("#role_id").val();
        //alert(role_id);
        if(typeof(role_id) == "undefined")
        {
            return false;
        }
        else {
            $.getJSON( base_url+"getRoleData/role_id/"+role_id, function( data ) {

                $('#tree_2').jstree({
                    'plugins': ["wholerow", "checkbox", "types"],
                    'core': {
                        "themes" : {
                            "responsive": false
                        },
                        'data': data
                    },
                    "types" : {
                        "default" : {
                            "icon" : "fa fa-folder icon-state-warning icon-lg"
                        },
                        "file" : {
                            "icon" : "fa fa-file icon-state-warning icon-lg"
                        }
                    }
                });
            });
        }


        var _selectedNodeId;

        $('#tree_2').on('select_node.jstree', function(e,data) {
            e.preventDefault();
            $("#Loaderaction").css('display','inline-block');
            var strt = data.selected.toString();
            //console.log(strt);
            console.log(data.node);
            var selectedElms = JSON.stringify(data.node);
            var role_id = $("#role_id").val();

            $.ajax({
                type: 'POST',
                url: base_url+'saveTree/&role_id='+role_id,
                data: 'id='+strt+'&data='+selectedElms,
                cache: false,
                success: function(data)
                {
                    console.log(data);
                    $("#Loaderaction").css('display','none');
                }
            });
        });



        $('#tree_2').on('deselect_node.jstree', function(e,data) {
            //alert($("#role_id").val());
            e.preventDefault();
            $("#Loaderaction").css('display','inline-block');
            var strt = data.selected.toString();
            //console.log(strt);
            console.log(data.node);
            var selectedElms = JSON.stringify(data.node);
            var role_id = $("#role_id").val();

            $("#tree_2").jstree(true).deselect_node($("#tree_2").jstree(true).get_node(data.node).children_d)

            $.ajax({
                type: 'POST',
                url: base_url+'updateTree&role_id='+role_id,
                data: 'selectedElms='+selectedElms,
                cache: false,
                success: function(data)
                {
                    console.log(data);
                    $("#Loaderaction").css('display','none');
                }
            });
        });



    }


    var handleSample6 = function () {

        $.getJSON( "http://localhost/avanzaweb/index.php?r=admin/getRoleData", function( data ) {

            $('#tree_6').jstree({
                'plugins': ["wholerow", "checkbox", "types"],
                'core': {
                    "themes" : {
                        "responsive": false
                    },
                    'data':  [{
                        "text": "Parent Node",
                        "children": [{
                            "text": "Initially selected",
                            "state": {
                                "selected": true
                            }
                        }, {
                            "text": "Custom Icon",
                            "icon": "fa fa-warning icon-state-danger"
                        }, {
                            "text": "Initially open",
                            "icon" : "fa fa-folder icon-state-success",
                            "state": {
                                "opened": true
                            },
                            "children": [
                                {"text": "Another node", "state": {
                                    "selected": true
                                }, "icon" : "fa fa-file icon-state-warning"}
                            ]
                        }, {
                            "text": "Another Custom Icon",
                            "icon": "fa fa-warning icon-state-warning"
                        }, {
                            "text": "Disabled Node",
                            "icon": "fa fa-check icon-state-success",
                            "state": {
                                "disabled": true
                            }
                        }, {
                            "text": "Sub Nodes",
                            "icon": "fa fa-folder icon-state-danger",
                            "children": [
                                {"text": "Item 1", "icon" : "fa fa-file icon-state-warning"},
                                {"text": "Item 2", "icon" : "fa fa-file icon-state-success"},
                                {"text": "Item 3", "icon" : "fa fa-file icon-state-default"},
                                {"text": "Item 4", "icon" : "fa fa-file icon-state-danger"},
                                {"text": "Item 5", "icon" : "fa fa-file icon-state-info"}
                            ]
                        }]
                    },
                        "Another Node"
                    ]
                },
                "types" : {
                    "default" : {
                        "icon" : "fa fa-folder icon-state-warning icon-lg"
                    },
                    "file" : {
                        "icon" : "fa fa-file icon-state-warning icon-lg"
                    }
                }
            });
        });

        $('#tree_6').on("get_json.jstree", function (e, data) {
            console.log(data.selected.attr("text"));
        });




    }

    var contextualMenuSample = function() {

        $("#tree_3").jstree({
            "core" : {
                "themes" : {
                    "responsive": false
                },
                // so that create works
                "check_callback" : true,
                'data': [{
                    "text": "Parent Node",
                    "children": [{
                        "text": "Initially selected",
                        "state": {
                            "selected": true
                        }
                    }, {
                        "text": "Custom Icon",
                        "icon": "fa fa-warning icon-state-danger"
                    }, {
                        "text": "Initially open",
                        "icon" : "fa fa-folder icon-state-success",
                        "state": {
                            "opened": true
                        },
                        "children": [
                            {"text": "Another node", "icon" : "fa fa-file icon-state-warning"}
                        ]
                    }, {
                        "text": "Another Custom Icon",
                        "icon": "fa fa-warning icon-state-warning"
                    }, {
                        "text": "Disabled Node",
                        "icon": "fa fa-check icon-state-success",
                        "state": {
                            "disabled": true
                        }
                    }, {
                        "text": "Sub Nodes",
                        "icon": "fa fa-folder icon-state-danger",
                        "children": [
                            {"text": "Item 1", "icon" : "fa fa-file icon-state-warning"},
                            {"text": "Item 2", "icon" : "fa fa-file icon-state-success"},
                            {"text": "Item 3", "icon" : "fa fa-file icon-state-default"},
                            {"text": "Item 4", "icon" : "fa fa-file icon-state-danger"},
                            {"text": "Item 5", "icon" : "fa fa-file icon-state-info"}
                        ]
                    }]
                },
                    "Another Node"
                ]
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder icon-state-warning icon-lg"
                },
                "file" : {
                    "icon" : "fa fa-file icon-state-warning icon-lg"
                }
            },
            "state" : { "key" : "demo2" },
            "plugins" : [ "contextmenu", "dnd", "state", "types" ]
        });

    }

    var ajaxTreeSample = function() {

        $("#tree_4").jstree({
            "core" : {
                "themes" : {
                    "responsive": false
                },
                // so that create works
                "check_callback" : true,
                'data' : {
                    'url' : function (node) {
                        return '../demo/jstree_ajax_data.php';
                    },
                    'data' : function (node) {
                        return { 'parent' : node.id };
                    }
                }
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder icon-state-warning icon-lg"
                },
                "file" : {
                    "icon" : "fa fa-file icon-state-warning icon-lg"
                }
            },
            "state" : { "key" : "demo3" },
            "plugins" : [ "dnd", "state", "types" ]
        });

    }


    return {
        //main function to initiate the module
        init: function () {
            $('#html1').jstree({'plugins': ["wholerow", "checkbox", "types"],
                'core': {
                    "themes" : {
                        "responsive": false
                    },

                },
                "types" : {
                    "default" : {
                        "icon" : "fa fa-folder icon-state-warning icon-lg"
                    },
                    "file" : {
                        "icon" : "fa fa-file icon-state-warning icon-lg"
                    }
                }});
            //handleSample1();
            handleSample2();
            //contextualMenuSample();
            //ajaxTreeSample();
            //handleSample6();


        }

    };

}();

jQuery(document).ready(function() {
    UITree.init();
});