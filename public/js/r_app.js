$(function(){

  /* footer 제어 */
  $('#footer_more_btn').click( function() {

      if( $(this).html() == '사업자정보 ▼' ) {
        $(this).html('사업자정보 ▲');
        $("#footer_hide_content").css("display","block");
      } else {
        $(this).html('사업자정보 ▼');
        $("#footer_hide_content").css("display","none");
      }

    });


  /* juqery ui 설정 */
    var dateToday = new Date();
  $( ".datepicker" ).datepicker({
      dateFormat: 'yy-mm-dd' //Input Display Format 변경
      ,showOtherMonths: true //빈 공간에 현재월의 앞뒤월의 날짜를 표시
      ,showMonthAfterYear:true //년도 먼저 나오고, 뒤에 월 표시
      ,yearSuffix: "년" //달력의 년도 부분 뒤에 붙는 텍스트
      ,monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'] //달력의 월 부분 텍스트
      ,monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'] //달력의 월 부분 Tooltip 텍스트
      ,dayNamesMin: ['일','월','화','수','목','금','토'] //달력의 요일 부분 텍스트
      ,dayNames: ['일요일','월요일','화요일','수요일','목요일','금요일','토요일'] //달력의 요일 부분 Tooltip 텍스트
      ,minDate: dateToday
  });

  $(".selectmenu").selectmenu();
  $(".spinner").spinner();

});

