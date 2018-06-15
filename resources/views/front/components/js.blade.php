<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@if (!isset($layoutFlg))
    <script src="{{asset("assets/js/common.js")}}"></script>
    @endif
<script src="{{asset("assets/js/jquery.matchHeight.js")}}"></script>


<script src="{{asset("bower_components/bootstrap/dist/js/bootstrap.min.js")}}" type="text/javascript"></script>
<script src="{{asset("bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js")}}" type="text/javascript"></script>
<script src="{{asset("bower_components/admin-lte/dist/js/adminlte.min.js")}}" type="text/javascript"></script>
<script src="{{asset("bower_components/bootstrap-fileinput/js/fileinput.min.js")}}" type="text/javascript"></script>
<script src="{{asset("js/canvas-to-blob.min.js")}}" type="text/javascript"></script>
<script src="{{ asset('js/ajaxzip3.js') }}" charset="UTF-8"></script>


<script src="{{asset("assets/angular.js")}}"></script>

<script src="{{asset("assets/angular-animate.js")}}"></script>
<script src="{{asset("assets/angular-aria.js")}}"></script>

<script src="{{asset("assets/angular-material.js")}}"></script>

<script src="{{asset("assets/ng-file-upload/angular-file-upload.js")}}"></script>
<script src="{{asset("assets/ng-file-upload/angular-file-upload-shim.js")}}"></script>

<script type="text/javascript" src="{{asset("assets/qr-code/raphael-2.1.0-min.js")}}"></script>

<script src='{{asset("assets/word-cloud/d3.v3.min.js")}}'></script>
<script src='{{asset("assets/word-cloud/d3.layout.cloud.js")}}'></script>

<script src="{{asset("assets/angular-sanitize.min.js")}}"></script>
<script src="{{asset("assets/ng-scrollbar.min.js")}}"></script>

<script src="{{asset("assets/fabric/fabric.js")}}"></script>
<script src="{{asset("assets/fabric/fabric.min.js")}}"></script>
<script src="{{asset("assets/fabric/fabricCanvas.js")}}"></script>
<script src="{{asset("assets/fabric/fabricConstants.js")}}"></script>
<script src="{{asset("assets/fabric/fabricDirective.js")}}"></script>
<script src="{{asset("assets/fabric/fabricDirtyStatus.js")}}"></script>
<script src="{{asset("assets/fabric/fabricUtilities.js")}}"></script>
<script src="{{asset("assets/fabric/fabricWindow.js")}}"></script>
<script src="{{asset("assets/fabric/fabric.customiseControls.js")}}"></script>

<script src="{{asset("assets/colorpicker/bootstrap-colorpicker-module.js")}}"></script>
<script src="{{asset("js/application.js")}}"></script>

<script src="{{asset("assets/file/fileSaver.js")}}"></script>
<script src="{{asset("assets/pdf/jspdf.debug.js")}}"></script>

<script>
    $(function(){
        $(".pickup li").matchHeight();
        $(".feature li").matchHeight();
    });
</script>
@stack('script')