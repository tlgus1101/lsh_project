<?php

/**
 * The file downloaded from
 * https://github.com/caouecs/Laravel-lang/blob/master/ko/validation.php
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */
    'after_or_equal' => ':attribute 은 :date 보다 빠르거나 같아야 합니다.',

    'before_or_equal' => ':attribute 은 :date 보다 늦거나 같아야 합니다.',


    'accepted' => ':attribute을(를) 동의하지 않았습니다.',

    'active_url' => ':attribute 값이 유효한 URL이 아닙니다.',

    'after' => ':attribute 값이 :date 보다 이후 날짜가 아닙니다.',

    'alpha' => ':attribute 값에 문자 외의 값이 포함되어 있습니다.',

    'alpha_dash' => ':attribute 값에 문자,
     숫자,
      대쉬(-) 외의 값이 포함되어 있습니다.',

    'alpha_num' => ':attribute 값에 문자와 숫자 외의 값이 포함되어 있습니다.',

    'array' => ':attribute 값이 유효한 목록 형식이 아닙니다.',

    'before' => ':attribute 값이 :date 보다 이전 날짜가 아닙니다.',

    'between' => [
        'numeric' => ':attribute 값이 :min ~ :max 값을 벗어납니다.',

        'file' => ':attribute 값이 :min ~ :max 킬로바이트를 벗어납니다.',

        'string' => ':attribute 값이 :min ~ :max 글자가 아닙니다.',

        'array' => ':attribute 값이 :min ~ :max 개를 벗어납니다.',

    ],

    'boolean' => ':attribute 값이 true 또는 false 가 아닙니다.',

    'confirmed' => ':attribute 와 :attribute 확인 값이 서로 다릅니다.',

    'date' => ':attribute 값이 유효한 날짜가 아닙니다.',

    'date_format' => ':attribute 값이 :format 형식과 일치하지 않습니다.',

    'different' => ':attribute 값이 :other은(는) 서로 다르지 않습니다.',

    'digits' => ':attribute 값이 :digits 자릿수가 아닙니다.',

    'digits_between' => ':attribute 값이 :min ~ :max 자릿수를 벗어납니다.',

    'distinct' => ':attribute 값에 중복된 항목이 있습니다.',

    'email' => ':attribute 값이 형식에 맞지 않습니다.',

    'exists' => ':attribute 값에 해당하는 리소스가 존재하지 않습니다.',

    'filled' => ':attribute 값은 필수 항목입니다.',

    'image' => ':attribute 값이 이미지가 아닙니다.',

    'in' => ':attribute 값이 유효하지 않습니다.',

    'in_array' => ':attribute 값이 :other 필드의 요소가 아닙니다.',

    'integer' => ':attribute 값이 정수가 아닙니다.',

    'ip' => ':attribute 값이 유효한 IP 주소가 아닙니다.',

    'json' => ':attribute 값이 유효한 JSON 문자열이 아닙니다.',

    'max' => [
        'numeric' => ':attribute 값이 :max 보다 큽니다.',

        'file' => ':attribute 값이 :max 킬로바이트보다 큽니다.',

        'string' => ':attribute 값이 :max 글자보다 많습니다.',

        'array' => ':attribute 값이 :max 개보다 많습니다.',

    ],

    'mimes' => ':attribute 값이 :values 와(과) 다른 형식입니다.',

    'min' => [
        'numeric' => ':attribute 값이 :min 보다 작습니다.',

        'file' => ':attribute 값이 :min 킬로바이트보다 작습니다.',

        'string' => ':attribute 값이 :min 글자 이상으로 작성하셔야합니다.',

        'array' => ':attribute 값이 :max 개보다 적습니다.',

    ],

    'not_in' => ':attribute 값이 유효하지 않습니다.',

    'numeric' => ':attribute 값이 숫자가 아닙니다.',

    'present' => ':attribute 필드가 누락되었습니다.',

    'regex' => ':attribute 값의 형식이 유효하지 않습니다.',

    'required' => ':attribute 항목은 필수 항목입니다.',

    'required_if' => ':attribute 값이 누락되었습니다 (:other 값이 :value 일 때는 필수).',

    'required_unless' => ':attribute 값이 누락되었습니다 (:other 값이 :value 이(가) 아닐 때는 필수).',

    'required_with' => ':attribute 값이 누락되었습니다 (:values 값이 있을 때는 필수).',

    'required_with_all' => ':attribute 값이 누락되었습니다 (:values 값이 있을 때는 필수).',

    'required_without' => ':attribute 값이 누락되었습니다 (:values 값이 없을 때는 필수).',

    'required_without_all' => ':attribute 값이 누락되었습니다 (:values 값이 없을 때는 필수).',

    'same' => ':attribute 값이 :other 와 서로 다릅니다.',

    'size' => [
        'numeric' => ':attribute 값이 :size 가 아닙니다.',

        'file' => ':attribute 값이 :size 킬로바이트가 아닙니다.',

        'string' => ':attribute 값이 :size 글자가 아닙니다.',

        'array' => ':attribute 값이 :max 개가 아닙니다.',

    ],

    'string' => ':attribute 값이 글자가 아닙니다.',

    'timezone' => ':attribute 값이 올바른 시간대가 아닙니다.',

    'unique' => ':attribute 값은 이미 사용 중입니다.',

    'url' => ':attribute 값이 유효한 URL이 아닙니다.',


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',

        ],

    ],


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes' => [
        // 운영관리 - 계약상품 - 상품등록
        'partner_contract_product_name' => '상품이름',
        'partner_contract_product_price' => '상품금액',
        'partner_contract_product_information' => '상품정보',

        // 파트너관리 - 파트너 - 파트너등록 - 파트너 정보
        'partner_id' => '아이디',
        'partner_password' => '비밀번호',
        'partner_name' => '이름',
        'partner_email' => '이메일',
        'partner_contact' => '연락처',
        'partner_type' => '유형',
        'partner_zipcode' => '우편번호',
        'partner_address' => '주소',
        'partner_address_detail' => '주소 상세',

        // 파트너관리 - 파트너 - 파트너등록 - 사업자정보
        'partner_businessman_name' => '사업자 명칭',
        'partner_businessman_number' => '사업자 번호',
        'partner_businessman_zipcode' => '사업자 우편번호',
        'partner_businessman_address' => '사업자 주소',
        'partner_businessman_address_detail' => '사업자 주소 상세',
        'partner_businessman_business' => '사업자 업종',
        'partner_businessman_sectors' => '사업자 업태',
        'partner_businessman_rep_name' => '대표자 이름',
        'partner_businessman_rep_number' => '대표자 연락처',
        'partner_businessman_rep_email' => '대표자 이메일',

        // 파트너관리 - 파트너 - 파트너등록 - 계약정보
        'partner_contract_sales_manager' => '영업 담당자',
        'partner_contract_product_idx' => '계약 상품',
        'partner_contract_enrollment_date' => '계약일',
        'partner_contract_end_date' => '종료일',
        'partner_contract_payment_way' => '결제방법',
        'partner_contract_calculate_way' => '정산방법',
        'partner_contract_bank' => '입금은행',
        'partner_contract_accountnumber' => '입금 계좌번호',
        'partner_contract_accountholder' => '입금 예금주',

        // 파트너관리 - 객실시설 - 객실시설등록
        'facilities_name' => '시설이름',
        'facilities_icon' => '아이콘',

        // 파트너관리 - 공지사항 - 공지사항등록
        'partner_notice_title' => '제목',
        'partner_notice_contents' => '내용',

        // 환경설정 - 팝업성정 - 팝업등록
        'popup_location_information' => '팝업 정보',

        // 환경설정 - 관리자 - 관리자등록
        'administrator_id' => '아이디',
        'administrator_password' => '비밀번호',
        'administrator_name' => '이름',
        'administrator_contact' => '연락처',
        'administrator_email' => '이메일',
        'administrator_level' => '등급',

        // 내정보
        'administrator_contact' => '전화번호',
        'password' => '비밀번호',
        'password_confirm' => '비밀번호 확인',

        // 예약 등록
        'reservation_orderer_name' => '이름',
        'reservation_orderer_contact' => '전화번호',

    ],

];
