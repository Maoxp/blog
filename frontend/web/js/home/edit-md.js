$(function () {
    var editor = editormd("editor", {
        placeholder:'本编辑器支持Markdown编辑，左边编写，右边预览',  //默认显示的文字，这里就不解释了
        // width: "90%",
        height: 940,
        syncScrolling: "single",
        /**设置主题颜色*/
        editorTheme: "default",
        theme: "simple",         //工具栏主题 ["default", "dark"]
        previewTheme: "default",           //预览主题  ["default", "dark"]
        // editorTheme: "pastel-on-white",      //编辑主题
        imageUpload : true,
        imageFormats : ["jpg","jpeg","gif","png","bmp","webp"],
        imageUploadURL : "/default/upload",       //上传图片使用方法
        saveHTMLToTextarea: true,
        emoji: true,
        taskList: true,
        tocm: true,                  // Using [TOCM]
        tex: true,                   // 开启科学公式TeX语言支持，默认关闭
        // htmlDecode:"style,script,iframe",
        // flowChart: false,             // 开启流程图支持，默认关闭
//            sequenceDiagram: false,       // 开启时序/序列图支持，默认关闭
        // markdown: "",     // dynamic set Markdown text
        path : "../../resource/editormd/lib/"  // Autoload modules mode, codemirror, marked... dependents libs path
    });
});