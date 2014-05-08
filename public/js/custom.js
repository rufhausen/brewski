$(function () {

    $("textarea").markdown({
        additionalButtons: [
            [
                {
                    name: "groupCustom",
                    data: [
                        {
                            name: "cmdMore",
                            toggle: true, // this param only take effect if you load bootstrap.js
                            title: "More",
                            icon: "fa fa-arrows-h",
                            callback: function (e) {
                                var text = '<!--more-->';
                                e.replaceSelection(text)
                            }
                        },
                        {
                            name: "cmdCode",
                            toggle: true,
                            title: "Wrap Code",
                            icon: "fa fa-code",
                            callback: function (e) {
                                start_wrap = '<code class="prettyprint">'
                                end_wrap = '</code>'
                                selected = e.getSelection()
                                content = start_wrap + selected.text + end_wrap
                                e.replaceSelection(start_wrap + selected.text + end_wrap)
                                cursor = selected.start
                                e.setSelection(cursor, cursor + content.length)

                            }
                        }
                    ]
                }
            ]
        ]
    })

    $('#datetimepicker1').datetimepicker();

});
