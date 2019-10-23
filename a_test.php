<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- 현재 작성하고 있는 파일은 UTF-8 DOS파일입니다.-->
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  </head>
  <body>
  	<div id="ex_js_syntax">
      <script type="text/javascript" language="javascript">
      
      

        function onfocus_event(){
          /* onfocus 이벤트 */
          alert("onfocus 실행되였어요");
        }
        function onblur_event(){

            var memberId = document.getElementById('memberId').value;
          /* onblur 이벤트 */
          alert(memberId);
        }
        function onchange_event(){
          /* onblur 이벤트 */
          alert("onchange 실행되였어요");
        }

      </script>
      <form name="input_type" id="input_type" method="post">

        <input id="memberId" type="text" value="" onblur="onblur_event();">
        
      </form>
    </div>
  </body>
</html>

