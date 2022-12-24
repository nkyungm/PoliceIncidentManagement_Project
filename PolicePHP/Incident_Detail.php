<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>

<body>
<hr width = "100%" color = "#1369B8" size = "60">
<h3> &nbsp&nbsp&nbsp&nbsp&nbsp사건 상세 페이지 </h3>
<hr width = "100%" color = "#1369B8" size = "10">
<br>
<a href = "police1.html"> <--홈으로 </a>
<input type="button" value="수정하로 가기" onclick = "location='Incident_Update1.php?incidentId=${1}'" />

    <table border='1'>
        <tr>
            <th>사건 ID
            <td>1</td>
            </th>
        </tr>

        <tr>
        <th>사건 종류
            <td>살인</td>
        </th>
        </tr>

        <tr>
            <th>팀
                <td>
                    북구 경찰서 형사과 1팀 1986-11-03 13:00:00 ~ 진행중 <br>
                    북구 경찰서 형사과 2팀 1986-11-03 13:00:00 ~ 진행중
                </td>
               
            </th>
        </tr>

        <tr>
            <th>시작일시
                <td>1986-11-01 15:00:00</td>
            </th>
        </tr>

        <tr>
            <th>종료일시
                <td>1987-11-01 15:00:00</td>
            </th>
        </tr>

        <tr>
            <th>사건 발생 주소
                <td>서구 서구2로 초밥아파트 1동</td>
            </th>
        </tr>

        <tr>
            <th>진행도
                <td>완료</td>
            </th>
        </tr>

        <tr>
            <th>신고자
                <td>
                    <a href="/policePHP/Incident_Applicant.php?applicant_id=45&incident_id=48" >구본식(19990727)</a> <br>
                </td>
            </th>
        </tr>

        <tr>
            <th>가해자
                <td>
                    <a href="/policePHP/Incident_suspect.php?suspect_id=30&incident_id=30" >이창협(19991213)</a> <br>
                    <a href="/policePHP/Incident_suspect.php?suspect_id=31&incident_id=30" >구세바리(19990707)</a> <br>
                </td>
            </th>
        </tr>

        <tr>
            <th>피해자
                <td>
                    <a href="/policePHP/Incident_Victim.php?victim_id=19&incident_id=30">강복수(19890102)</a> <br>
                </td>
            </th>
        </tr>

        <tr>
            <th>보고서
                <td>
                    <a href="/policePHP/Incident_Report.php?report_id=29">북구 경찰서 형사과 2팀(작성일:1990-12-10 07:30:00)</a> <br>
                    <a href="/policePHP/Incident_Report.php?report_id=30">북구 경찰서 형사과 3팀(작성일:1990-01-10 14:30:00)</a> <br>
                    <a href="/policePHP/Incident_Report.php?report_id=32">북구 경찰서 형사과 1팀(작성일:2022-11-13 09:52:18)</a> <br>
                </td>
            </th>
        </tr>

    </table>


</body>

</html>