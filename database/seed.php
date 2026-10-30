<?php
// 50 real programmes. Deadlines are left blank on purpose: confirm each on the official site, then set it in the admin panel.
function seed(PDO $pdo){
$M="Master's"; $F='Fully funded'; $P='Partially funded';
$d=[
['Chevening Scholarships','UK Foreign, Commonwealth & Development Office','United Kingdom',$M,$F,'chevening.org','One-year UK master\'s for future leaders, including many African countries.'],
['Commonwealth Master\'s Scholarships','Commonwealth Scholarship Commission','United Kingdom',$M,$F,'cscuk.fcdo.gov.uk','For students from low and middle income Commonwealth countries.'],
['Commonwealth PhD Scholarships','Commonwealth Scholarship Commission','United Kingdom','PhD',$F,'cscuk.fcdo.gov.uk','Doctoral study in the UK for Commonwealth citizens.'],
['Gates Cambridge Scholarship','Gates Cambridge Trust','United Kingdom','PhD',$F,'gatescambridge.org','Full-cost postgraduate scholarships at the University of Cambridge.'],
['Rhodes Scholarship','Rhodes Trust','United Kingdom',$M,$F,'rhodeshouse.ox.ac.uk','Postgraduate study at Oxford, with dedicated African constituencies.'],
['Oxford Clarendon Scholarships','University of Oxford','United Kingdom','PhD',$F,'ox.ac.uk','Awards for graduate students across Oxford, based on academic merit.'],
['Cambridge Mastercard Foundation Scholarship','University of Cambridge','United Kingdom',$M,$F,'cam.ac.uk','For African students with academic talent and leadership potential.'],
['Edinburgh Mastercard Foundation Scholars','University of Edinburgh','United Kingdom',$M,$F,'ed.ac.uk','Postgraduate scholarships for African students committed to giving back.'],
['Imperial President\'s PhD Scholarships','Imperial College London','United Kingdom','PhD',$F,'imperial.ac.uk','Doctoral funding across science, engineering, medicine and business.'],
['Manchester Equity and Merit Scholarship','University of Manchester','United Kingdom',$M,$P,'manchester.ac.uk','Support for students from lower-income countries.'],
['LSE Graduate Support Scheme','London School of Economics','United Kingdom',$M,$P,'lse.ac.uk','Need-based funding for master\'s students.'],
['UBC Mastercard Foundation Scholars Program','University of British Columbia','Canada','Undergraduate',$F,'ubc.ca','Undergraduate and master\'s awards for African scholars.'],
['Vanier Canada Graduate Scholarships','Government of Canada','Canada','PhD',$F,'vanier.gc.ca','Doctoral awards for Canadian and international students.'],
['Lester B. Pearson International Scholarship','University of Toronto','Canada','Undergraduate',$F,'utoronto.ca','Four-year undergraduate award for outstanding international students.'],
['Fulbright Foreign Student Program','U.S. Department of State','United States',$M,$F,'foreign.fulbrightonline.org','Graduate study and research in the U.S., applied through your home country.'],
['Knight-Hennessy Scholars','Stanford University','United States','PhD',$F,'knight-hennessy.stanford.edu','Fully funded graduate study at Stanford for future leaders.'],
['Schwarzman Scholars','Schwarzman Scholars','China',$M,$F,'schwarzmanscholars.org','One-year master\'s in global affairs at Tsinghua University.'],
['Yenching Academy Scholarship','Peking University','China',$M,$F,'yenchingacademy.pku.edu.cn','Master\'s in China Studies at Peking University.'],
['Chinese Government Scholarship (CSC)','China Scholarship Council','China',$M,$F,'campuschina.org','Study at Chinese universities, covering tuition, housing and stipend.'],
['DAAD Development-Related Postgraduate Courses','DAAD','Germany',$M,$F,'daad.de','Master\'s in development-related fields for professionals from developing countries.'],
['DAAD EPOS Scholarships','DAAD','Germany',$M,$F,'daad.de','Study in Germany with a focus on development cooperation.'],
['Erasmus Mundus Joint Masters','European Commission','Europe',$M,$F,'erasmus-plus.ec.europa.eu','Joint master\'s degrees taught in several European countries.'],
['Swiss Government Excellence Scholarships','Swiss Confederation','Switzerland','PhD',$F,'sbfi.admin.ch','Research and postgraduate funding in Switzerland.'],
['ETH Zurich Excellence Scholarship','ETH Zurich','Switzerland',$M,$F,'ethz.ch','For top master\'s students in science and engineering.'],
['Eiffel Excellence Scholarship','Campus France','France',$M,$F,'campusfrance.org','Master\'s and PhD programmes at French institutions.'],
['Swedish Institute Scholarships for Global Professionals','Swedish Institute','Sweden',$M,$F,'si.se','Master\'s in Sweden for leaders from selected countries.'],
['Norwegian Quota Scheme','Norwegian Government','Norway',$M,$F,'studyinnorway.no','Programme for students from developing countries.'],
['Finland Scholarship Programme','Finnish National Agency for Education','Finland',$M,$P,'studyinfinland.fi','Tuition support for non-EU master\'s students.'],
['Danish Government Scholarships','Danish Agency for Higher Education','Denmark',$M,$P,'studyindenmark.dk','Scholarships for talented international students.'],
['Holland Scholarship','Dutch Ministry of Education','Netherlands',$M,$P,'studyinholland.nl','Contribution toward study costs at Dutch institutions.'],
['VLIR-UOS Scholarships','VLIR-UOS','Belgium',$M,$F,'vliruos.be','Master\'s and training programmes in Flemish universities.'],
['ARES Scholarships','ARES Belgium','Belgium',$M,$F,'ares-ac.be','Study and training in French-speaking Belgium.'],
['Italian Government Scholarships','Italian Ministry of Foreign Affairs','Italy',$M,$F,'maeci.it','Scholarships for foreign students at Italian institutions.'],
['Stipendium Hungaricum','Tempus Public Foundation','Hungary',$M,$F,'stipendiumhungaricum.hu','Tuition-free study in Hungary with stipend and housing.'],
['Turkiye Burslari','Republic of Turkiye','Turkey',$M,$F,'turkiyeburslari.gov.tr','Full scholarships at Turkish universities.'],
['MEXT Japanese Government Scholarship','Government of Japan','Japan',$M,$F,'studyinjapan.go.jp','Study in Japan with tuition, allowance and travel.'],
['Joint Japan/World Bank Graduate Scholarship','World Bank','Multiple countries',$M,$F,'worldbank.org','Development-focused master\'s study at partner universities.'],
['Korean Government Scholarship (GKS)','Government of South Korea','South Korea',$M,$F,'studyinkorea.go.kr','Graduate and undergraduate study in Korea.'],
['Australia Awards','Government of Australia','Australia',$M,$F,'australiaawards.gov.au','Study in Australia for people from partner countries.'],
['Manaaki New Zealand Scholarships','New Zealand MFAT','New Zealand',$M,$F,'mfat.govt.nz','Study in New Zealand for development-focused students.'],
['Mastercard Foundation Scholars Program','Mastercard Foundation','Africa & worldwide','Undergraduate',$F,'mastercardfdn.org','Network of partner universities across Africa and beyond.'],
['Mandela Rhodes Scholarship','Mandela Rhodes Foundation','South Africa','Honours / Master\'s',$F,'mandelarhodes.org','Postgraduate study in South Africa plus leadership development.'],
['AIMS Master\'s in Mathematical Sciences','African Institute for Mathematical Sciences','Rwanda',$M,$F,'aims.ac.rw','Structured master\'s at AIMS centres across Africa.'],
['Aga Khan Foundation International Scholarship','Aga Khan Foundation','Multiple countries',$M,$P,'akdn.org','Postgraduate funding for outstanding students with financial need.'],
['Rotary Peace Fellowship','Rotary International','Multiple countries','Fellowship',$F,'rotary.org','Master\'s or certificate in peace and conflict studies.'],
['Mo Ibrahim Foundation Leadership Fellowship','Mo Ibrahim Foundation','Africa','Fellowship',$F,'mo.ibrahim.foundation','Leadership fellowship placements in African institutions.'],
['Tony Elumelu Entrepreneurship Programme','Tony Elumelu Foundation','Africa','Fellowship',$P,'tefconnect.com','Seed funding and training for African entrepreneurs.'],
['African Union Mwalimu Nyerere Scholarship','African Union','Africa',$M,$F,'au.int','Intra-African mobility for master\'s and PhD students.'],
['UNESCO Fellowships Programme','UNESCO','Multiple countries','Fellowship',$P,'unesco.org','Short-term research and study fellowships.'],
];
$pp=$pdo->prepare('INSERT IGNORE INTO providers(name) VALUES(?)'); $pid=$pdo->prepare('SELECT id FROM providers WHERE name=?');
$ins=$pdo->prepare("INSERT INTO scholarships(title,slug,provider_id,description,eligibility,benefits,country_of_study,degree_level,funding_type,application_url,featured) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
foreach($d as $i=>$r){ $pp->execute([$r[1]]); $pid->execute([$r[1]]); $id=$pid->fetchColumn();
 $slug=trim(preg_replace('/[^a-z0-9]+/','-',strtolower($r[0])),'-');
 $ins->execute([$r[0],$slug,$id,$r[6].' Run by '.$r[1].'. Intake dates and rules change every year, so read the current call on the official website.',
 'Open to eligible African applicants. Typical requirements: a strong academic record, proof of nationality, and a clear study plan. Check the exact criteria for your country.',
 $r[4]=='Fully funded'?'Usually covers tuition and living costs. Travel and extras vary by programme.':'Covers part of the costs. Check what the award includes.',
 $r[2],$r[3],$r[4],'https://'.$r[5],$i<6?1:0]); }
}
