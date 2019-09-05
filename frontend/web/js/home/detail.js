$(function () {
    var testEditor = editormd.markdownToHTML("markdown", {//注意：这里是上面DIV的id
        htmlDecode : "style,script,iframe",
        emoji : true,
        taskList : true,
        tex : true, // 默认不解析
        flowChart : true, // 默认不解析
        sequenceDiagram : true, // 默认不解析
        codeFold : true,
        path : "../../resource/editormd/lib/"  // Autoload modules mode, codemirror, marked... dependents libs path
    });
});