<!-- <form id="openLmsForm" method="POST" action="{{ route('open_lms') }}" target="lmsWindow"> -->
<form id="openLmsForm" method="POST" action="http://mdb4.payfactor.ft:8083/lms/" target="lmsWindow">
    @csrf
    <button onclick="openLms()">Open LMS</button>
</form>




<script>
function openLms() {
    // Open a new tab first (some browsers block it if done after delay)
/* const newWindow = window.open('', 'lmsWindow');
    if (newWindow) {
        document.getElementById('openLmsForm').submit();
    } else {
        alert('Please allow popups for this site to open the LMS.');
    }
} */
alert(132);
}
document.getElementById('openLmsForm').submit();

</script>