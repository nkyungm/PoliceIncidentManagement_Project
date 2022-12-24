<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>

<body>
<hr width = "100%" color = "#1369B8" size = "60">
<h3> &nbsp&nbsp&nbsp&nbsp&nbsp사건 조회 결과 </h3>
<hr width = "100%" color = "#1369B8" size = "10">
<br>
<a href = "police1.html"> <--홈으로 </a>

    <table width='1100' border='1' cellpadding='1' cellspace='0' style='table-layout:fixed;'>
	<th>사건 ID</th>
	<th>종류</th>
    <th>팀</th>
    <th>시작일시</th>
    <th>종료일시</th>
    <th>진행도</th>
    <th>주소</th>

    <!-- while문으로 반복 -->
	<tr><!-- 첫번째 줄 시작 -->
	    <td>
            <a href="Incident_Details.php?incidentId=${1}">1</a>
        </td>

	    <td>살인</td>
       
        <td style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">
            <span class="tooltip" title="북구 경찰서 여성 청소년과 2팀 2022-09-04 19:20:16 ~ 진행중"> 북구 경찰서 여성 청소년과 2팀 2022-09-04 19:20:16 ~ 진행중</span>
        </td>
    
        <td>2020-10-10 15:00:00</td>
        <td>2022-12-10 17:00:00</td>
        <td>완료</td>

        <td style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">
            <span class="tooltip" title="북구 태전 1동 삼성아파트 7동"> 북구 태전 1동 삼성아파트 7동</span>
        </td>

        
        <td>
            <input type="button" value="신고자 추가" onclick = "location='/PolicePHP/Incident_AddApplicant.php?incident_id=30'"/>
        </td>
        <td>
            <input type="button" value="가해자 추가" onclick = "location='/PolicePHP/Incident_AddSuspect.php?incident_id=30'"/>
        </td>
        <td>
            <input type="button" value="피해자 추가" onclick = "location='/PolicePHP/Incident_AddVictim.php?incident_id=30'" />
        </td>
        <td>
            <input type="button" value="보고서 쓰기" onclick = "location='/PolicePHP/Incident_AddReport.php?incident_id=6&team_id=62'" />
        </td>
	</tr><!-- 첫번째 줄 끝 -->

</body>

</html>