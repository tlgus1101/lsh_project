@extends('layouts.app')

@section('title')

@endsection

@section('style')
  <link rel="stylesheet" href="/css/slick.css">
  <link rel="stylesheet" href="/css/daterangepicker.css">
  <link rel="stylesheet" href="/css/swiper.min.css">
  <link rel="stylesheet" href="/css/product.css">
@endsection

@section('content')

  <section class="probootstrap-cover overflow-hidden relative"
           style="background-image: url('//cloudfront.mo-zip.co.kr/mo-zip/images/agreement_img.JPG'); padding: 2em 0 0"
           data-stellar-background-ratio="0.5"
           id="section-home">
    <div class="overlay"></div>
    <div class="container top-container">
      <div class="row align-items-center text-center">
        <div class="col-md">
          <h2 class="heading mb-2 display-5 font-light probootstrap-animate">개인정보 처리방침</h2>
        </div>
      </div>
    </div>
  </section>
  <!-- END section -->


  <section class="probootstrap-cover overflow-hidden relative pt-5 font-70">
    <div class="container" style="color: #000;">

      <strong class="display-6">(주)블루웹에서는 귀하의 개인정보보호를 매우 중요시하며, 『정보통신망이용촉진등에관한법률』을 준수하고 있습니다.<br>
          본 개인정보처리방침은 「한국정보보호진흥원(KISA)」에서 제공한 『표준 웹사이트 개인정보보호방침』에 의거하여 작성되었습니다.<br>
          (주)블루웹은 개인정보처리방침을 통하여 귀하께서 제공하시는 개인정보가 어떠한 용도와 방식으로 이용되고 있으며 개인정보보호를 위해 어떠한 조치가 취해지고 있는지 알려드립니다.<br><br>


      - 본 개인정보처리방침은 모집(MOZIP) 서비스 웹 및 앱에 적용됩니다.<br><br></strong><br>


      <strong class="display-6">제 1 조 개인정보의 수집목적 및 이용목적</strong><br><br>
      &nbsp;1. 당사는 이용자 확인, 예약 결제 등의 목적으로써 귀하에게 최적의 서비스를 제공하기 위한 목적으로 귀하의 개인정보를 수집·이용하고 있습니다.<br><br>
      &nbsp;2.	수집하는 개인정보 항목에 따른 구체적인 수집목적 및 이용목적은 다음과 같습니다.<br><br>
      &nbsp;&nbsp;①	 회원<br>
      &nbsp;&nbsp;&nbsp;i. 필수정보<br>
      &nbsp;&nbsp;&nbsp;&nbsp;(1)	회원가입<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -	휴대전화번호, 기기고유번호(IMEI)<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -	이메일 : 이메일, 비밀번호, 닉네임<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -	카카오톡 : 이메일(카카오계정), 닉네임<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -	네이버 : 이메일(네이버계정), 닉네임<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -	페이스북 : 이메일(페이스북계정), 닉네임<br>
      &nbsp;&nbsp;&nbsp;&nbsp;  -	구글 : 이메일(구글계정), 닉네임<br>
      &nbsp;&nbsp;&nbsp;&nbsp;(2)	서비스이용<br>
      &nbsp;&nbsp;&nbsp;&nbsp;(3)	예약/결제<br>
      &nbsp;&nbsp;&nbsp;&nbsp;(4)	취소, 환불에 따른 대금지급<br>
      &nbsp;&nbsp;&nbsp;&nbsp;(5)	고객상담 / 민원처리<br>
      &nbsp;&nbsp;&nbsp;&nbsp;(6) 이벤트진행<br>
      &nbsp;&nbsp;&nbsp;ii.	선택정보<br>
      &nbsp;&nbsp;&nbsp;&nbsp;(1)	개인 맞춤 상품 및 서비스혜택<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -	휴대전화번호<br>
      &nbsp;&nbsp;&nbsp;iii.	보유/이용기간<br>
      &nbsp;&nbsp;&nbsp;&nbsp;관계법령에 따라 보존할 필요가 있는 경우 해당 법령에서 요구하는 기한까지 보관<br>
      &nbsp;&nbsp;&nbsp;&nbsp;이용종료일부터 7일 후 삭제<br><br>
      &nbsp;&nbsp;②	비회원<br>
      &nbsp;&nbsp;&nbsp;i. 필수정보<br>
      &nbsp;&nbsp;&nbsp;&nbsp;(1)	서비스 이용<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-	예약자명 휴대전화번호<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-	서비스 이용기록<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-	이용 정지 기록<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-	이용 해지 기록<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-	IP<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-	접속 로그<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-	Cookie<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-	단말기OS와 버전<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-	단말기 모델명<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-	브라우저 버전<br>
      &nbsp;&nbsp;&nbsp;&nbsp;(2)	예약/결제<br>
      &nbsp;&nbsp;&nbsp;&nbsp;(3)	취소, 환불에 따른 대금지급<br>
      &nbsp;&nbsp;&nbsp;&nbsp;(4)	고객상담 / 민원처리<br>
      &nbsp;&nbsp;&nbsp;ii.	선택정보<br>
      &nbsp;&nbsp;&nbsp;&nbsp;(1) 개인맞춤상품 및 서비스혜택<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-	휴대전화 번호<br>
      &nbsp;&nbsp;&nbsp;iii.	보유/이용기간<br>
      &nbsp;&nbsp;&nbsp;&nbsp;관계법령에 따라 보존할 필요가 있는 경우 해당 법령에서 요구하는 기한까지 보관<br>
      &nbsp;&nbsp;&nbsp;&nbsp;이용종료일부터 7일 후 삭제<br><br>
      &nbsp;3.	장기 미이용 회원은 모집 최종 이용 후 1년동안 기록이 없는 회원을 말하며, 대상자에게 안내는 탈퇴처리일 기준으로 최소 30일 이전과 탈퇴처리 후 두번에 걸쳐 이메일로 전송합니다.<br><br>
      &nbsp;법령에 의해 수집되는 회원 정보<br>
      &nbsp;&nbsp;&nbsp;&nbsp;(1)	계약 또는 철회에 관한 기록 : 5년<br>
      &nbsp;&nbsp;&nbsp;&nbsp;(2)	대금 결제 및 재화 등의 공급에 관한 기록 : 5년<br>
      &nbsp;&nbsp;&nbsp;&nbsp;(3)	소비자 불만 또는 분쟁처리 관한 기록 : 3년<br>
      &nbsp;&nbsp;&nbsp;&nbsp;(4)	표시/광고에 관한 기록 : 5개월<br>
      &nbsp;&nbsp;&nbsp;&nbsp;(5)	웹사이트 방문 기록 : 3개월<br><br>

      &nbsp;&nbsp;&nbsp;&nbsp;<span>(1)~(4) : 전자상거래 등에서의 소비자보호에 관한 법률</span><br>
      &nbsp;&nbsp;&nbsp;&nbsp;<span>(5) : 통신비밀보호법</span><br><br>


      <strong class="display-6">제 2 조 개인정보의 수집방법</strong><br><br>
      &nbsp;1.	회사가 개인정보를 수집하는 경우 반드시 사전에 이용자에게 해당 사실을 알리고 동의를 구하고 있으며, 아래와 같은 방법으로 개인정보를 수집합니다.<br><br>
      &nbsp;&nbsp;①	홈페이지 회원가입 및 서비스 이용과정 중 이용자가 개인정보 수집에 대해 동의하고 직접 정보를 입력하는 경우<br>
      &nbsp;&nbsp;②	제휴 또는 단체 등으로부터 개인정보를 제공받는 경우<br>
      &nbsp;&nbsp;③	고객센터를 통한 상담과정 중 웹페이지, 메일, 팩스, 전화 등을 통하는 경우<br>
      &nbsp;&nbsp;④	온라인/오프라인에서 진행하는 이벤트, 행사 등을 통하는 경우<br><br>


      <strong class="display-6">제 3 조 개인정보의 제3자 제공 및 공유</strong><br><br>
      &nbsp;회사는 이용자의 동의가 있거나 관련법령의 규정에 의한 경우를 제외하고는 「개인정보의 수집목적 및 이용목적」에서 고지한 범위를 넘어 귀하의 개인정보를 이용하거나 타인 또는 타기업·기관에 제공하지 않습니다. 귀하의 개인정보를 제공하거나 공유하는 경우에는 사전에 귀하에게 제공받거나 공유하는 자가 누구이며 주된 사업이 무엇인지, 제공 또는 공유되는 개인정보항목이 무엇인지, 개인정보를 제공하거나 공유하는 목적이 무엇인지 등에 대해 사전에 이용자에게 해당 사실을 알리고 동의를 받은 내용만을 제공하겠습니다.<br><br>
      &nbsp;1.	숙박서비스/공간대여서비스 제휴자 – 예약자명, 예약자 전화번호 제공하며, 예약서비스 제공 완료 후 6개월까지 유지다만, 아래의 경우에는 예외로 합니다.<br><br>
      &nbsp;&nbsp;①	관계법령에 의하여 수사상의 목적으로 공공기관으로부터 요구가 있을 경우<br>
      &nbsp;&nbsp;②	통계작성, 학술연구나 시장조사를 위하여 특정 개인을 식별할 수 없는 형태로 연구단체 등에 제공하는 경우<br>
      &nbsp;&nbsp;③	기타 관계법령에서 정한 절차에 따른 요청이 있을 경우<br><br>


      <strong class="display-6"> 제 4 조 개인정보의 처리위탁</strong><br><br>
      &nbsp;회사는 서비스 향상을 위해서 아래와 같이 개인정보를 위탁하고 있으며, 관계 법령에 따라 위탁계약시 개인정보가 안전하게 관리될 수 있도록 필요한 사항을 규정하고 있습니다. 회사의 개인정보 위탁처리 기관 및 위탁업무 내용은 아래와 같습니다.<br><br>
      &nbsp;1.	서울신용평가정보㈜<br><br>
      &nbsp;&nbsp;①위탁사무 및 목적 : 회원관리 회원제 서비스 이용에 따른 본인확인 (휴대전화 인증, i-PIN 인증, 범용 공인 인증 등)<br>
      &nbsp;&nbsp;②보유/이용기관 : 본인확인 기관인 이들 기관에서 이미 보유한 개인정보이므로 별도로 저장하지 않음<br><br>
      &nbsp;2.	㈜텔넷웨어<br><br>
      &nbsp;&nbsp;①위탁사무 및 목적 : SMS/LMS/MMS 발송<br>
      &nbsp;&nbsp;②보유/이용기관 : 회원 탈퇴 시 또는 위탁 계약 만료 때 까지<br><br>


      <strong class="display-6">제 5 조 개인정보 수집에 대한 동의</strong><br><br>
      &nbsp;당사는 귀하의 개인정보 수집에 대한 동의를 받고 있습니다. 귀하의 개인정보 수집과 관련하여 (주)블루웹의 이용약관(개인정보처리방침 포함)의 내용에 대해 「동의」또는 「취소」버튼을 클릭할 수 있는 절차를 마련하고 있으며, 귀하가 「동의」버튼을 클릭하면 개인정보 수집에 대해 동의한 것으로 봅니다.<br><br>


      <strong class="display-6">제 6 조 개인정보보호책임자 및 개인정보보호담당자</strong><br><br>
      &nbsp;귀하의 개인정보를 보호하고 개인정보와 관련한 불만을 처리하기 위하여 당사는 개인정보보호책임자를 두고 있습니다. 개인정보와 관련한 문의사항이 있으시면 아래의 개인정보보호책임자에게 연락 주시기 바랍니다. 귀하의 문의사항에 신속하고 성실하게 답변해드리겠습니다.<br>
      &nbsp;&nbsp;-	개인정보보호책임자 : 김경아 | 서비스사업부 | 실장 | restar0825@blueweb.co.kr | 02-3429-1910<br>
      &nbsp;&nbsp;-	개인정보보호담당자 : 김종현 | 서비스사업부 | 팀장 | jhyun11@blueweb.co.kr | 02-3429-1910<br><br>
      &nbsp;기타 개인정보침해에 대한 신고나 상담이 필요하신 경우에는 아래 기관에 문의하시기 바랍니다.<br>
      &nbsp;&nbsp;-	개인분쟁조정위원회 (http:..www.kopico.go.kr, 1833-6972)<br>
      &nbsp;&nbsp;-	대검찰청 사이버수사과 (http://www.spo.go.kr, 3480-2700)<br>
      &nbsp;&nbsp;-	경찰청 사이버 수사과 (http://www.cyberbureau.police.go.kr, 182)<br>
      &nbsp;&nbsp;-	정보보호마크인증위원회 (http://www.eprivary.or.kr, 02-550-9531~2)<br><br>


      <strong class="display-6">제 7 조 개인정보보호를 위한 기술적, 관리적 대책</strong><br><br>
      &nbsp;이용자의 개인정보는 비밀번호에 의해 보호되고 있습니다. 이용자의 계정 비밀번호는 오직 귀하만이 알 수 있으며, 개인정보의 확인 및 변경도 비밀번호를 알고 있는 본인에 의해서만 가능합니다. 따라서 이용자의 비밀번호는 누구에게도 알려주면 안됩니다. 비밀번호 등이 공공장소에 설치한 PC를 통해 유출되지 않도록 항상 유의하시기 바랍니다. 귀하의 ID와 비밀번호는 반드시 본인만 사용하시고 비밀번호를 자주 바꿔주시는 것이 좋습니다. 이용자 부주의나 인터넷상의 문제로 인한 개인정보 유출에 대해서 회사는 책임을 지지 않습니다.<br>
      &nbsp;회사는 개인정보 처리 직원을 제한하고 담당 직원의 수시교육을 통해 개인정보 보호 정책의 준수를 강조하고 있습니다.<br><br>
      &nbsp;회사는 개인정보보호를 위한 기술적 관리적 대책을 다음과 같이 시행하고 있습니다.<br><br>
      &nbsp;1.	해킹 방지를 위한 방화벽과 보안 시스템을 운영하고 있습니다.<br><br>
      &nbsp;2.	개인정보 송수신시 SSL 보안서버 인증서를 설치하여 정보를 보호합니다.<br><br>
      &nbsp;3.	개인정보에의 접근은 해당 업무 수행자, 업무 수행 시 개인정보 취급이 불가피한 자로 제한하여 그 이외의 직원이 접근하지 못하도록 하고 있습니다.<br><br>

      <strong class="display-6">제 8 조 개인정보 자동수집 장치의 설치, 운영 및 그 거부에 관한 사항</strong><br><br>
      &nbsp;회사는 이용자의 정보를 수시로 저장하고 찾아내는 ' 쿠키(cookie)'를 운용합니다. 쿠키란 모집 서비스를 운영하는데 이용되는 서버가 귀하의 브라우저에 보내는 작은 텍스트 파일로서 귀하의 컴퓨터 하드디스크에 저장됩니다.<br>
      &nbsp;(주)블루웹은 다음과 같은 목적을 위해 쿠키를 사용합니다.<br><br>
      &nbsp;1.	웹사이트 인증을 위하여 ID가 저장된 쿠키를 사용하고 있으나, 고객의 서비스 이용을 위한 인증 외에 다른 용도로는 사용하고 있지 않습니다.<br><br>
      &nbsp;2.	회원과 비회원의 접속 빈도나 방문시간 등을 분석하고 이용자의 취향과 관심분야를 파악하여 타겟 (target) 마케팅 및 서비스 개편 등의 척도로 활용합니다.<br><br>
      &nbsp;3.	파트너 제도의 정책 적용을 위하여 사용합니다. 귀하는 쿠키 설치에 대한 선택권을 가지고 있습니다. 따라서, 귀하는 웹 브라우저에서 모든 쿠키를 허용하거나, 쿠키가 저장될 때마다 확인을 거치거나, 아니면 모든 쿠키의 저장을 거부할 수도 있습니다.<br><br>
      &nbsp;쿠키 설정 거부 방법<br><br>
      &nbsp;인터넷 익스플로러 : 도구 > 인터넷 옵션 > 개인정보 > 고급<br>
      &nbsp;회원님께서 쿠키 설치를 거부하셨을 경우 모집 서비스 제공에 어려움이 있습니다.<br><br>


      <strong class="display-6">제 9 조 이용자 및 법정대리인의 권리와 그 행사방법</strong><br><br>
      &nbsp;이용자 및 법정대리인의 권리와 그 행사방법<br><br>
      &nbsp;1. 이용자는 언제든지 등록되어 있는 자신의 개인정보를 열람하거나 정정할 수 있으며 가입 해지를 요청할 수도 있습니다.<br><br>
      &nbsp;2. 이용자가 자신의 개인정보 조회, 수정을 위해서는 '회원정보변경'(또는 '회원정보수정' 등)을, 가입해지(동의철회)를 위해서는 ‘회원탈퇴’를 클릭하여 본인 확인 절차를 거치신 후 직접 열람, 정정 또는 탈퇴가 가능합니다.<br><br>
      &nbsp;3. 혹은 개인정보보호책임자에게 서면, 전화 또는 이메일로 연락하시면 지체 없이 조치하겠습니다.<br><br>
      &nbsp;4. 이용자가 개인정보의 오류에 대한 정정을 요청하신 경우에는 정정을 완료하기 전까지 당해 개인정보를 이용 또는 제공하지 않습니다. 또한 잘못된 개인정보를 제3자에게 이미 제공한 경우에는 정정 처리결과를 제3자에게 지체 없이 통지하여 정정이 이루어지도록 하겠습니다.<br><br>
      &nbsp;5. 회사는 이용자 혹은 법정대리인의 요청에 의해 해지 또는 삭제된 개인정보는 ‘제 11 조'에 명시된 바에 따라 처리하고 그 외의 용도로 열람 또는 이용할 수 없도록 처리하고 있습니다.<br><br>

      <strong class="display-6">제 10 조 동의 철회(회원탈퇴)</strong><br><br>
      &nbsp;이용자는 회원가입 시 개인정보의 수집·이용 및 제공에 대해 동의하신 내용을 언제든지 철회하실 수 있습니다. 동의철회(회원탈퇴)는 모집 홈페이지의 마이페이지에서 「회원정보 변경」를 클릭하여 본인 확인 절차를 거치신 후 직접 동의철회(회원탈퇴)를 하시거나, 개인정보보호책임자 또는 담당자에게 서면, 전화 또는 E-mail 등으로 연락하시면 지체 없이 귀하의 개인정보를 파기하는 등 필요한 조치를 하겠습니다.<br><br>


      <strong class="display-6">제 11 조 개인정보의 보유기간 및 이용기간</strong><br><br>
      &nbsp;이용자의 개인정보는 원칙적으로 개인정보의 수집 및 이용목적이 달성되면 지체 없이 파기합니다.<br><br>
      &nbsp;단, 다음의 정보에 대해서는 아래의 이유로 명시한 기간 동안 보존합니다<br><br>
      &nbsp;4.	회원탈퇴 시 보존 개인정보<br><br>
      &nbsp;&nbsp;①	보존항목: 회원님께서 제공한 이름, 아이디, 이메일주소, 주소, 전화번호 등<br>
      &nbsp;&nbsp;②	나. 보존근거: 불량 이용자의 재가입 방지, 명예훼손 등 권리침해 분쟁 및 수사협조<br>
      &nbsp;&nbsp;③	다. 보존기간: 회원탈퇴 후 1년<br><br>
      &nbsp;5.	관련법령에 의한 정보보유 사유<br><br>
      &nbsp;상법, 전자상거래 등에서의 소비자보호에 관한 법률 등 관계법령의 규정에 의하여 보존할 필요가 있는 경우 회사는 관계법령에서 정한 일정한 기간 동안 회원정보를 보관합니다. 이 경우 회사는 보관하는 정보를 그 보관의 목적으로만 이용하며 보존기간은 아래와 같습니다.<br>
      &nbsp;법령에 의해 수집되는 회원 정보<br><br>
      &nbsp;&nbsp;(1)	계약 또는 철회에 관한 기록 : 5년<br>
      &nbsp;&nbsp;(2)	대금 결제 및 재화 등의 공급에 관한 기록 : 5년<br>
      &nbsp;&nbsp;(3)	소비자 불만 또는 분쟁처리 관한 기록 : 3년<br>
      &nbsp;&nbsp;(4)	표시/광고에 관한 기록 : 5개월<br>
      &nbsp;&nbsp;(5)	웹사이트 방문 기록 : 3개월<br>
      &nbsp;&nbsp;(1)~(4) : 전자상거래 등에서의 소비자보호에 관한 법률<br>
      &nbsp;&nbsp;(5) : 통신비밀보호법<br><br>


      <strong class="display-6">제 12 조 개인정보의 파기절차 및 방법</strong><br><br>
      &nbsp;1.	파기절차<br><br>
      &nbsp;회원님이 회원가입 등을 위해 입력하신 정보는 목적이 달성된 후 내부 방침 및 기타 관련 법령에 의한 정보보호 사유에 따라(개인정보의 보유기간 및 이용기간 참조) 일정 기간 저장된 후 파기됩니다. 동 개인정보는 법률에 의한 경우가 아니고서는 보유되는 이외의 다른 목적으로 이용되지 않습니다.<br><br>
      &nbsp;2.	파기방법<br><br>
      &nbsp;종이에 출력된 개인정보는 분쇄기로 분쇄하거나 소각을 통하여 파기하고 전자적 파일형태로<br>
      &nbsp;저장된 개인정보는 기록을 재생할 수 없는 기술적 방법을 사용하여 삭제합니다<br><br>


      <strong class="display-6">제 13 조 만14세 미만의 아동의 개인정보보호</strong><br><br>
      &nbsp;민법상 미성년자인 회원이 서비스를 이용할 경우 결제 전 법정대리인의 동의를 얻어야 하며, 만 14세 미만 아동의 경우 본 서비스를 이용할 수 없습니다.<br><br>


      <strong class="display-6">제 14 조 의견수렴 및 불만처리</strong><br><br>
      &nbsp;회사는 이용자의 권리를 보호하고 의견을 소중하게 생각하며, 의문사항으로부터 언제나 성실한 답변을 받을 권리가 있습니다.<br>
      &nbsp;회사는 이용자와의 의견수렴 및 불만처리를 접수받기 위해 고객센터를 운영하고 있으며 연락처는 아래와 같습니다.<br><br>
      &nbsp;[고객센터]<br>
      &nbsp;&nbsp;-	전자우편 : mozip@blueweb.co.kr<br>
      &nbsp;&nbsp;-	전화번호 : 02-3429-1910<br>
      &nbsp;&nbsp;-	주소 : 서울특별시 성동구 성수일로 8길5 SKV1타워, B동 3층<br><br>


      <strong class="display-6">제 14 조 정책 변경에 따른 공지의무</strong><br><br>
      &nbsp;이 개인정보처리방침은 2019년 11월 18일에 제정되었으며 법령·정책 또는 보안기술의 변경에 따라 내용의 추가·삭제 및 수정이 있을 시에는 변경되는 개인정보처리방침을 시행하기 최소 7일전에 모집 홈페이지를 통해 변경 이유 및 내용 등을 공지하도록 하겠습니다.<br><br>

      &nbsp;&nbsp;- 공고일자 : 2019년 11월 18일<br>
      &nbsp;&nbsp;- 시행일자 : 2019년 11월 18일
    </div>
  </section>

@endsection

@section('scripts')
@endsection
