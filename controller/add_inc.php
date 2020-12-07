<?php 
 include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";


$code['016'] = [
                1=>[
                    7=>"Source specified in subfield $2"
                    ]
                ];
$code['017'] = [
                2=>[
                    8=>"No display constant generated"
                    ]
                ];
$code['022'] = [
                1=>[
                    '#'=>"No level specified ",
                    0=>"Continuing resource of international interest",
                    1=>"Continuing resource not of international interest"
                    ]
                ];
$code['024'] = [
                1=>[
                    0=>"International Standard Recording Code",
                    1=>"Universal Product Code",
                    2=>"International Standard Music Number",
                    3=>"International Article Number",
                    4=>"Serial Item and Contribution Identifier",
                    7=>"Source specified in subfield $2",
                    8=>"Unspecified type of standard number or code"
                    ],
                2=>[
                    '#'=>"No information provided",
                    0=>"No difference",
                    1=>"Difference"
                    ]
                ];
$code['028'] = [
                1=>[
                    0=>"Issue number",
                    1=>"Matrix number",
                    2=>"Plate number",
                    3=>"Other music publisher number",
                    4=>"Video recording publisher number",
                    5=>"Other publisher number",
                    6=>"Distributor number",
                    ],
                2=>[
                    0=>"No note, no added entry",
                    1=>"Note, added entry",
                    2=>"Note, no added entry",
                    3=>"No note, added entry",
                    ]
                ];
$code['033'] = [
                1=>[
                    '#'=>"No date information",
                    0=>"Single date",
                    1=>"Multiple single dates",
                    2=>"Range of dates",
                    ],
                2=>[
                    '#'=>"No information provided",
                    0=>"Capture",
                    1=>"Broadcast",
                    2=>"Finding",
                    ]
                ];
$code['034'] = [
                1=>[
                    0=>"Scale indeterminable/No scale recorded",
                    1=>"Single scale",
                    3=>"Range of scales",
                    ],
                2=>[
                    '#'=>"Not applicable",
                    0=>"Outer ring",
                    1=>"Exclusion ring",
                    ]
                ];
$code['037'] = [
                1=>[
                    '#'=>"Not applicable/No information provided/Earliest",
                    2=>"Intervening",
                    3=>"Current/Latest",
                    ]
                ];

$code['041'] = [
                1=>[
                    '#'=>"No information provided",
                    0=>"Item not a translation/does not include a translation",
                    1=>"Item is or includes a translation",
                    ],
                2=>[
                    '#'=>"MARC language code",
                    7=>"Source specified in subfield $2",
                    ]
                ];
$code['045'] = [
                1=>[
                    '#'=>"Subfield #b or #c not present ",
                    0=>"Single date/time ",
                    1=>"Multiple single dates/times ",
                    2=>"Range of dates/times ",
                    ],
                ];
$code['047'] = [
                2=>[
                    '#'=>"MARC musical composition code ",
                    7=>"Source specified in subfield $2 ",
                    ]
                ];
                
$code['048'] = [
                2=>[
                    '#'=>"MARC code ",
                    7=>"Source specified in subfield $2 ",
                    ]
                ];

$code['050'] = [
                1=>[
                    '#'=>"No information provided",
                    0=>"Item is in LC",
                    1=>"Item is not in LC",
                    ],
                2=>[
                    0=>"Assigned by LC",
                    4=>"Assigned by agency other than LC",
                    ]
                ];

$code['052'] = [
                1=>[
                    '#'=>"Library of Congress Classification",
                    1=>"U.S. Dept. of Defense Classification",
                    7=>"Source specified in subfield $2",
                    ],
                ];


$code['055'] = [
                1=>[
                    '#'=>"Information not provided",
                    0=>"Work held by LAC",
                    1=>"Work not held by LAC",
                    ],
                2=>[
                    0=>"LC-based call number assigned by LAC",
                    1=>"Complete LC class number assigned by LAC",
                    2=>"Incomplete LC class number assigned by LAC",
                    3=>"LC-based call number assigned by the contributing library",
                    4=>"Complete LC class number assigned by the contributing library",
                    5=>"Incomplete LC class number assigned by the contributing library",
                    6=>"Other call number assigned by LAC",
                    7=>"Other class number assigned by LAC",
                    8=>"Other call number assigned by the contributing library",
                    9=>"Other class number assigned by the contributing library",
                    ]
                ];
$code['060'] = [
                1=>[
                    '#'=>"No information provided",
                    0=>"Item is in NLM",
                    1=>"Item is not in NLM",
                    ],
                2=>[
                    0=>"Assigned by NLM",
                    4=>"Assigned by agency other than NLM",
                    ]
                ];



$code['070'] = [
                1=>[
                    '#'=>"No information provided",
                    0=>"Item is in NAL",
                    1=>"Item is not in NAL",
                    ],
                ];



$code['072'] = [
                2=>[
                    0=>"NAL subject category code list ",
                    7=>"Source specified in subfield $2 ",
                    ]
                ];

$code['080'] = [
                1=>[
                    '#'=>"No information provided",
                    0=>"Full",
                    1=>"Abridged",
                    ],
                ];

$code['082'] = [
                1=>[
                    0=>"Full edition",
                    1=>"Abridged edition",
                    7=>"Other edition specified in subfield $2",
                    ],
                2=>[
                    '#'=>"No information provided",
                    0=>"Assigned by LC",
                    4=>"Assigned by agency other than LC",
                    ]
                ];
$code['083'] = [
                1=>[
                    0=>"Full edition",
                    1=>"Abridged edition",
                    7=>"Other edition specified in subfield $2",
                    ],
                ];



$code['086'] = [
                1=>[
                    '#'=>"Source specified in subfield $2",
                    0=>"Superintendent of Documents Classification System",
                    1=>"Government of Canada Publications: Outline of Classification",
                    ],
                ];

$code['100'] = [
                1=>[
                    0=>"Forename",
                    1=>"Surname",
                    3=>"Family name",
                    ],
                ];

$code['110'] = [
                1=>[
                    0=>"Inverted name",
                    1=>"Jurisdiction name",
                    2=>"Name in direct order",
                    ]
                ];

$code['111'] = [
                1=>[
                    0=>"Inverted name",
                    1=>"Jurisdiction name",
                    2=>"Name in direct order",
                    ]
                ];

$code['210'] = [
                1=>[
                    0=>"No added entry",
                    1=>"Added entry",
                    ],
                2=>[
                    '#'=>"Abbreviated key title",
                    0=>"Other abbreviated title",
                    ]
                ];

$code['240'] = [
                1=>[
                    0=>"Not printed or displayed",
                    1=>"Printed or displayed",
                    ],
                ];


$code['242'] = [
                1=>[
                    0=>"No added entry",
                    1=>"Added entry",
                    ],
                ];
$code['243'] = [
                1=>[
                    0=>"Not printed or displayed",
                    1=>"Printed or displayed",
                    ],
                ];
$code['245'] = [
                1=>[
                    0=>"No added entry",
                    1=>"Added entry",
                    ],
                ];

$code['246'] = [
                1=>[
                    0=>"Note, no added entry",
                    1=>"Note, added entry",
                    2=>"No note, no added entry",
                    3=>"No note, added entry",
                    ],
                2=>[
                    '#'=>"No type specified",
                    0=>"Portion of title",
                    1=>"Parallel title",
                    2=>"Distinctive title",
                    3=>"Other title",
                    4=>"Cover title",
                    5=>"Added title page title",
                    6=>"Caption title",
                    7=>"Running title",
                    8=>"Spine title",
                    ]
                ];

                
$code['247'] = [
                1=>[
                    '#'=>"No added entry",
                    0=>"Added entry",
                    ],
                2=>[
                    '#'=>"Display note",
                    0=>"Do not display note",
                    ]
                ];
$code['260'] = [
                1=>[
                    '#'=>"Not applicable/No information provided/Earliest available publisher",
                    2=>"Intervening publisher",
                    3=>"Current/latest publisher",
                    ],
                ];
$code['264'] = [
                1=>[
                    '#'=>"Not applicable/No information provided/Earliest",
                    2=>"Intervening",
                    3=>"Current/Latest",
                    ],
                2=>[
                    0=>"Production",
                    1=>"Publication",
                    2=>"Distribution",
                    3=>"Manufacture",
                    4=>"Copyright notice date",
                    ]
                ];
$code['270'] = [
                1=>[
                    '#'=>"No level specified",
                    1=>"Primary",
                    2=>"Secondary",
                    ],
                2=>[
                    '#'=>"No type specified",
                    0=>"Mailing",
                    7=>"Type specified in subfield #i",
                    ]
                ];
$code['307'] = [
                1=>[
                    '#'=>"Hours",
                    8=>"No display constant generated",
                    ],
                ];
$code['341'] = [
                1=>[
                    '#'=>"No information provided",
                    0=>"Adaptive features to access primary content",
                    1=>"Adaptive features to access secondary content",
                    ],
                ];
$code['342'] = [
                1=>[
                    0=>"Horizontal coordinate system",
                    1=>"Vertical coordinate system",
                    ],
                2=>[
                    0=>"Geographic",
                    1=>"Map projection",
                    2=>"Grid coordinate system",
                    3=>"Local planar",
                    4=>"Local",
                    5=>"Geodetic model",
                    6=>"Altitude",
                    7=>"Method specified in $2",
                    8=>"Depth",
                    ]
                ];
$code['355'] = [
                1=>[
                    0=>"Document",
                    1=>"Title",
                    2=>"Abstract",
                    3=>"Contents note",
                    4=>"Author",
                    5=>"Record",
                    8=>"None of the above",
                    ],
                ];
$code['362'] = [
                1=>[
                    0=>"Formatted style",
                    1=>"Unformatted note",
                    ],
                ];
$code['363'] = [
                1=>[
                    '#'=>"No information provided",
                    0=>"Starting information",
                    1=>"Ending information",
                    ],
                2=>[
                    '#'=>"Not specified",
                    0=>"Closed",
                    1=>"Open",
                    ]
                ];
$code['377'] = [
                2=>[
                    '#'=>"MARC language code",
                    7=>"Source specified in $2",
                    ]
                ];
$code['382'] = [
                1=>[
                    '#'=>"No information provided",
                    0=>"Medium of performance",
                    1=>"Partial medium of performance",
                    ],
                2=>[
                    '#'=>"No information provided",
                    0=>"Not intended for access",
                    1=>"Intended for access",
                    ]
                ];
$code['384'] = [
                1=>[
                    '#'=>"Relationship to original unknown",
                    0=>"Original key",
                    1=>"Transposed key",
                    ],
                ];
$code['388'] = [
                1=>[
                    '#'=>"No information provided",
                    1=>"Creation of work",
                    2=>"Creation of aggregate work",
                    ],
                ];
$code['490'] = [
                1=>[
                    0=>"Series not traced",
                    1=>"Series traced",
                    ],
                ];
$code['505'] = [
                1=>[
                    0=>"Contents",
                    1=>"Incomplete contents",
                    2=>"Partial contents",
                    8=>"No display constant generated",
                    ],
                2=>[
                    '#'=>"Basic",
                    0=>"Enhanced",
                    ]
                ];

$code['506'] = [
                1=>[
                    '#'=>"No information provided",
                    0=>"No restrictions",
                    1=>"Restrictions apply",
                    ],
                ];
$code['510'] = [
                1=>[
                    0=>"Coverage unknown",
                    1=>"Coverage complete",
                    2=>"Coverage is selective",
                    3=>"Location in source not given",
                    4=>"Location in source given",
                    ],
                ];
$code['511'] = [
                1=>[
                    0=>"No display constant generated",
                    1=>"Cast",
                    ],
                ];
$code['516'] = [
                1=>[
                    '#'=>"Type of file",
                    8=>"No display constant generated",
                    ],
                ];
$code['520'] = [
                1=>[
                    '#'=>"Summary",
                    0=>"Subject",
                    1=>"Review",
                    2=>"Scope and content",
                    3=>"Abstract",
                    4=>"Content advice",
                    8=>"No display constant generated",
                    ],
                ];
$code['521'] = [
                1=>[
                    '#'=>"Audience",
                    0=>"Reading grade level",
                    1=>"Interest age level",
                    2=>"Interest grade level",
                    3=>"Special audience characteristics",
                    4=>"Motivation/interest level",
                    8=>"No display constant generated",
                    ],
                ];
$code['522'] = [
                1=>[
                    '#'=>"Geographic coverage",
                    8=>"No display constant generated",
                    ],
                ];
$code['524'] = [
                1=>[
                    '#'=>"Cite as",
                    8=>"No display constant generated",
                    ],
                ];
$code['526'] = [
                1=>[
                    0=>"Reading program",
                    8=>"No display constant generated",
                    ],
                ];
$code['532'] = [
                1=>[
                    0=>"Accessibility technical details",
                    1=>"Accessibility features",
                    2=>"Accessibility deficiencies",
                    8=>"No display constant generated",
                    ],
                ];
$code['535'] = [
                1=>[
                    1=>"Holder of originals",
                    2=>"Holder of duplicates",
                    ],
                ];
$code['541'] = [
                1=>[
                    '#'=>"No information provided",
                    0=>"Private",
                    1=>"Not private",
                    ],
                ];
$code['542 '] = [
                1=>[
                    '#'=>"No information provided",
                    0=>"Private",
                    1=>"Not private",
                    ],
                ];
$code['544'] = [
                1=>[
                    '#'=>"No information provided",
                    0=>"Associated materials",
                    1=>"Related materials",
                    ],
                ];
$code['545'] = [
                1=>[
                    '#'=>"No information provided",
                    0=>"Biographical sketch",
                    1=>"Administrative history",
                    ],
                ];
$code['555'] = [
                1=>[
                    '#'=>"Indexes",
                    0=>"Finding aids",
                    8=>"No display constant generated",
                    ],
                ];
$code['556'] = [
                1=>[
                    '#'=>"Documentation",
                    8=>"No display constant generated",
                    ],
                ];
$code['561'] = [
                1=>[
                    '#'=>"No information provided",
                    0=>"Private",
                    1=>"Not private",
                    ],
                ];
$code['565'] = [
                1=>[
                    '#'=>"File size",
                    0=>"Case file characteristics",
                    8=>"No display constant generated",
                    ],
                ];
$code['567'] = [
                1=>[
                    '#'=>"Methodology",
                    8=>"No display constant generated",
                    ],
                ];
$code['581'] = [
                1=>[
                    '#'=>"Publications",
                    8=>"No display constant generated",
                    ],
                ];
$code['583'] = [
                1=>[
                    '#'=>"No information provided",
                    0=>"Private",
                    1=>"Not private",
                    ],
                ];
$code['586'] = [
                1=>[
                    '#'=>"Awards",
                    8=>"No display constant generated",
                    ],
                ];

$code['588'] = [
                1=>[
                    '#'=>"No information provided",
                    0=>"Source of description",
                    1=>"Latest issue consulted",                    
                    ],
                ];

$code['600'] = [
                1=>[
                    0=>"Forename",
                    1=>"Surname",
                    3=>"Family name",
                    ],
                2=>[
                    0=>"Library of Congress Subject Headings",
                    1=>"LC subject headings for children literature",
                    2=>"Medical Subject Headings",
                    3=>"National Agricultural Library subject authority file",
                    4=>"Source not specified",
                    5=>"Canadian Subject Headings",
                    6=>"Répertoire de vedettes-matière",
                    7=>"Source specified in subfield $2",
                    ]
                ];

$code['610'] = [
                1=>[
                    0=>"Inverted name",
                    1=>"Jurisdiction name",
                    2=>"Name in direct order",
                    ],
                2=>[
                    0=>"Library of Congress Subject Headings",
                    1=>"LC subject headings for children literature",
                    2=>"Medical Subject Headings",
                    3=>"National Agricultural Library subject authority file",
                    4=>"Source not specified",
                    5=>"Canadian Subject Headings",
                    6=>"Répertoire de vedettes-matière",
                    7=>"Source specified in subfield $2",
                    ]
                ];
$code['611'] = [
                1=>[
                    0=>"Inverted name",
                    1=>"Jurisdiction name",
                    2=>"Name in direct order",
                    ],
                2=>[
                    0=>"Library of Congress Subject Headings",
                    1=>"LC subject headings for children literature",
                    2=>"Medical Subject Headings",
                    3=>"National Agricultural Library subject authority file",
                    4=>"Source not specified",
                    5=>"Canadian Subject Headings",
                    6=>"Répertoire de vedettes-matière",
                    7=>"Source specified in subfield $2",
                    ]
                ];

$code['630'] = [
                2=>[
                    0=>"Library of Congress Subject Headings",
                    1=>"LC subject headings for children literature",
                    2=>"Medical Subject Headings",
                    3=>"National Agricultural Library subject authority file",
                    4=>"Source not specified",
                    5=>"Canadian Subject Headings",
                    6=>"Répertoire de vedettes-matière",
                    7=>"Source specified in subfield $2",
                    ]
                ];
$code['647'] = [
                2=>[
                    0=>"Library of Congress Subject Headings",
                    1=>"LC subject headings for children literature",
                    2=>"Medical Subject Headings",
                    3=>"National Agricultural Library subject authority file",
                    4=>"Source not specified",
                    5=>"Canadian Subject Headings",
                    6=>"Répertoire de vedettes-matière",
                    7=>"Source specified in subfield $2",
                    ]
                ];
$code['648'] = [
                2=>[
                    0=>"Library of Congress Subject Headings",
                    1=>"LC subject headings for children literature",
                    2=>"Medical Subject Headings",
                    3=>"National Agricultural Library subject authority file",
                    4=>"Source not specified",
                    5=>"Canadian Subject Headings",
                    6=>"Répertoire de vedettes-matière",
                    7=>"Source specified in subfield $2",
                    ]
                ];
$code['650'] = [
                1=>[
                    '#'=>"No information provided",
                    0=>"No level specified",
                    1=>"Primary",
                    2=>"Secondary",
                    ],
                2=>[
                    0=>"Library of Congress Subject Headings",
                    1=>"LC subject headings for children literature",
                    2=>"Medical Subject Headings",
                    3=>"National Agricultural Library subject authority file",
                    4=>"Source not specified",
                    5=>"Canadian Subject Headings",
                    6=>"Répertoire de vedettes-matière",
                    7=>"Source specified in subfield $2",
                    ]
                ];

$code['651'] = [
                2=>[
                    0=>"Library of Congress Subject Headings",
                    1=>"LC subject headings for children literature",
                    2=>"Medical Subject Headings",
                    3=>"National Agricultural Library subject authority file",
                    4=>"Source not specified",
                    5=>"Canadian Subject Headings",
                    6=>"Répertoire de vedettes-matière",
                    7=>"Source specified in subfield $2",
                    ]
                ];

$code['653'] = [
                1=>[
                    '#'=>"No information provided",
                    0=>"No level specified",
                    1=>"Primary",
                    2=>"Secondary",
                    ],
                2=>[
                    '#'=>"No information provided",
                    0=>"Topical term",
                    1=>"Personal name",
                    2=>"Corporate name",
                    3=>"Meeting name",
                    4=>"Chronological term",
                    5=>"Geographic name",
                    6=>"Genre/form term",
                    ]
                ];

$code['654'] = [
                1=>[
                    '#'=>"No information provided",
                    0=>"No level specified",
                    1=>"Primary",
                    2=>"Secondary",
                    ],
                ];

$code['655'] = [
                1=>[
                    '#'=>"Basic",
                    0=>"Faceted",
                    ],
                2=>[
                    0=>"Library of Congress Subject Headings",
                    1=>"LC subject headings for children literature",
                    2=>"Medical Subject Headings",
                    3=>"National Agricultural Library subject authority file",
                    4=>"Source not specified",
                    5=>"Canadian Subject Headings",
                    6=>"Répertoire de vedettes-matière",
                    7=>"Source specified in subfield $2",
                    ]
                ];
$code['656'] = [
                2=>[
                    7=>"Source specified in subfield $2",
                    ]
                ];
$code['657'] = [
                2=>[
                    7=>"Source specified in subfield $2",
                    ]
                ];
$code['700'] = [
                1=>[
                    0=>"Forename",
                    1=>"Surname",
                    3=>"Family name",
                    ],
                2=>[
                    '#'=>"No information provided",
                    7=>"Analytical entry",
                    ]
                ];
$code['710'] = [
                1=>[
                    0=>"Inverted name",
                    1=>"Jurisdiction name",
                    2=>"Name in direct order",
                    ],
                2=>[
                    '#'=>"No information provided",
                    2=>"Analytical entry",
                    ]
                ];
$code['711'] = [
                1=>[
                    0=>"Inverted name",
                    1=>"Jurisdiction name",
                    2=>"Name in direct order",
                    ],
                2=>[
                    '#'=>"No information provided",
                    2=>"Analytical entry",
                    ]
                ];
$code['720'] = [
                1=>[
                    '#'=>"Not specified",
                    1=>"Personal",
                    2=>"Other",
                    ],
                ];

$code['730'] = [
                2=>[
                    '#'=>"No information provided",
                    2=>"Analytical entry",
                    ]
                ];
$code['740'] = [
                2=>[
                    '#'=>"No information provided",
                    2=>"Analytical entry",
                    ]
                ];


$code['760'] = [
                1=>[
                    0=>"Display note",
                    1=>"Do not display note",
                    ],
                2=>[
                    '#'=>"Main series",
                    8=>"No display constant generated",
                    ]
                ];
                
$code['762'] = [
                1=>[
                    0=>"Display note",
                    1=>"Do not display note",
                    ],
                2=>[
                    '#'=>"Has subseries",
                    8=>"No display constant generated",
                    ]
                ];

$code['765'] = [
                1=>[
                    0=>"Display note",
                    1=>"Do not display note",
                    ],
                2=>[
                    '#'=>"Translation of",
                    8=>"No display constant generated",
                    ]
                ];
                
$code['767'] = [
                1=>[
                    0=>"Display note",
                    1=>"Do not display note",
                    ],
                2=>[
                    '#'=>"Translated as",
                    8=>"No display constant generated",
                    ]
                ];

$code['770'] = [
                1=>[
                    0=>"Display note",
                    1=>"Do not display note",
                    ],
                2=>[
                    '#'=>"Has supplement",
                    8=>"No display constant generated",
                    ]
                ];

$code['772'] = [
                1=>[
                    0=>"Display note",
                    1=>"Do not display note",
                    ],
                2=>[
                    '#'=>"Supplement to",
                    0=>"Parent",
                    8=>"No display constant generated",
                    ]
                ];

$code['773'] = [
                1=>[
                    0=>"Display note",
                    1=>"Do not display note",
                    ],
                2=>[
                    '#'=>"In",
                    8=>"No display constant generated",
                    ]
                ];
$code['774'] = [
                1=>[
                    0=>"Display note",
                    1=>"Do not display note",
                    ],
                2=>[
                    '#'=>"Constituent unit",
                    8=>"No display constant generated",
                    ]
                ];

$code['774'] = [
                1=>[
                    0=>"Display note",
                    1=>"Do not display note",
                    ],
                2=>[
                    '#'=>"Constituent unit",
                    8=>"No display constant generated",
                    ]
                ];

$code['775'] = [
                1=>[
                    0=>"Display note",
                    1=>"Do not display note",
                    ],
                2=>[
                    '#'=>"Other edition available",
                    8=>"No display constant generated",
                    ]
                ];

$code['776'] = [
                1=>[
                    0=>"Display note",
                    1=>"Do not display note",
                    ],
                2=>[
                    '#'=>"Available in another form",
                    8=>"No display constant generated",
                    ]
                ];

$code['777'] = [
                1=>[
                    0=>"Display note",
                    1=>"Do not display note",
                    ],
                2=>[
                    '#'=>"Issued with",
                    8=>"No display constant generated",
                    ]
                ];

$code['780'] = [
                1=>[
                    0=>"Display note",
                    1=>"Do not display note",
                    ],
                2=>[
                    0=>"Continues",
                    1=>"Continues in part",
                    2=>"Supersedes",
                    3=>"Supersedes in part",
                    4=>"Formed by the union of ... and ...",
                    5=>"Absorbed",
                    6=>"Absorbed in part",
                    7=>"Separated from",
                    ]
                ];

$code['785'] = [
                1=>[
                    0=>"Display note",
                    0=>"Do not display note",
                    ],
                2=>[
                    0=>"Continued by",
                    1=>"Continued in part by",
                    2=>"Superseded by",
                    3=>"Superseded in part by",
                    4=>"Absorbed by",
                    5=>"Absorbed in part by",
                    6=>"Split into ... and ...",
                    7=>"Merged with ... to form ...",
                    8=>"Changed back to",
                    ]
                ];

$code['786'] = [
                1=>[
                    0=>"Display note",
                    1=>"Do not display note",
                    ],
                2=>[
                    '#'=>"Data source",
                    8=>"No display constant generated",
                    ]
                ];

$code['787'] = [
                1=>[
                    0=>"Display note",
                    1=>"Do not display note",
                    ],
                2=>[
                    '#'=>"Related item",
                    8=>"No display constant generated",
                    ]
                ];



$code['800'] = [
                1=>[
                    0=>"Forename",
                    1=>"Surname",
                    3=>"Family name",
                    ],
                ];


$code['810'] = [
                1=>[
                    0=>"Inverted name",
                    1=>"Jurisdiction name",
                    2=>"Name in direct order",
                    ],
                ];


$code['811'] = [
                1=>[
                    0=>"Inverted name",
                    1=>"Jurisdiction name",
                    2=>"Name in direct order",
                    ],
                ];
$code['852'] = [
                1=>[
                    '#'=>"No information provided",
                    0=>"Library of Congress classification",
                    1=>"Dewey Decimal classification",
                    2=>"National Library of Medicine classification",
                    3=>"Superintendent of Documents classification",
                    4=>"Shelving control number",
                    5=>"Title",
                    6=>"Shelved separately",
                    7=>"Source specified in subfield $2",
                    8=>"Other scheme",
                    ],
                2=>[
                    '#'=>"No information provided",
                    0=>"Not enumeration",
                    1=>"Primary enumeration",
                    2=>"Alternative enumeration",
                    ]
                ];

                


$code['883'] = [
                1=>[
                    '#'=>"No information provided/not applicable",
                    0=>"Fully machine-generated",
                    1=>"Partially machine-generated",
                    ],
                ];


$code['886'] = [
                1=>[
                    0=>"Leader",
                    1=>"Variable control fields (002-009)",
                    2=>"Variable data fields (010-999)",
                    ],
                ];


$stack = "";

foreach ($code as $key => $value) {
    foreach ($code[$key] as $key2 => $value) {
        if ($key2==1||$key2==2) {
            foreach ($code[$key][$key2] as $key3 => $value2) {
                $stack .= "('$key','$key3','$value2','$key2'),";
            }
        }
    }
}

$stack = substr($stack,0,strlen($stack)-1);

$sql = "INSERT INTO indicator(Field,Code,Description,`Order`) VALUES $stack";


// echo $sql ;


if (!mysqli_query($conn,$sql))
  {
  echo("Error description: " . mysqli_error($conn));
  }
?>
