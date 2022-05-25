<object data="data:application/pdf;base64,<?php echo base64_encode($model['pdf'])?>#toolbar=0" type="application/pdf" width="100%" style="height: 100vh;"></object>
<script type="text/javascript">
document.onmousedown = disableRightclick;
var message = "Right click not allowed !!";
function disableRightclick(evt){
    if(evt.button == 2){
        alert(message);
        return false;    
    }
}
</script>