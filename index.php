<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<?php

set_time_limit(0);

include 'Markov.Class.php';

$Markov = new Markov(4, ' ', 'memorise');


// var_dump($Markov->generateInitial());

$englishQuestions = [
	"Choose a novel in which loyalty or bravery or trust plays an important part. Show how the writer explores the idea in a way which adds to your understanding of the central concern(s) of the text.",
	"Choose a novel in which the vulnerability of a central character is apparent at one or more than one key point in the text. Explain the situation(s) in which the character’s vulnerability emerges and discuss the importance of the vulnerability to your understanding of character and/or theme in the text as a whole.",
	"Choose a novel in which a character makes a decision which you consider unexpected or unwise or unworthy. Explain the circumstances surrounding the decision and discuss its importance to your understanding of character and theme in the novel as a whole.",
	"Choose a novel or short story in which ideas and/or characters and/or incidents appear to be designed to shock the reader. Explain what you find shocking about the text and discuss to what extent this enhances your understanding of the text as a whole.",
	"Choose a novel in which envy or malice or cruelty plays a significant part. Explain how the writer makes you aware of this aspect of the text and discuss how the writer’s exploration of it enhances your understanding of the text as a whole.",
	"Choose a novel in which a character is influenced by a particular location or setting. Explain how the character is influenced by the location or setting and discuss how this enhances your understanding of the text as a whole.",
	"Choose a novel or short story in which there is an act of kindness or of compassion. Explain briefly the nature of the act and discuss its importance to your understanding of the text as a whole.",
	"Choose a novel in which the death of a character clarifies an important theme in the text.Show how this theme is explored in the novel as a whole and discuss how the death of the character clarifies the theme.",
	"Choose two short stories in which a central character feels threatened or vulnerable. Compare how this situation is presented in each story and discuss which story is more effective in arousing your sympathy for the central character.",
	"Choose a novel or short story which explores loss or futility or failure. Discuss how the writer explores one of these ideas in a way you find effective.",
	"Choose a novel in which a main character refuses to accept advice or to conform to expectations. Explain the circumstances of the refusal and discuss its importance to your understanding of the character in the novel as a whole.",
	"Choose a novel in which a particular mood is dominant. Explain how the novelist creates this mood and discuss how it contributes to your appreciation of the novel as a whole.",
	"Choose a novel or short story in which there is a character who is not only realistic as a person but who has symbolic significance in the text as a whole. Show how the writer makes you aware of both aspects of the character.",
	"Choose a novel or short story which features a relationship between two characters which is confrontational or corrosive. Describe how the relationship is portrayed and discuss to what extent the nature of the relationship influences your understanding of the text as a whole.",
	"Choose a novel in which the novelist makes use of more than one location. Discuss how the use of different locations allows the novelist to develop the central concern(s) of the text.",
	"Choose a novel in which a character experiences a moment of revelation. Describe briefly what is revealed and discuss its significance to your understanding of character and/or theme.",
	"Choose a novel in which a character seeks to escape from the constraints of his or her environment or situation. Explain why the character feels the need to escape and show how his or her response to the situation illuminates a central concern of the text.",
	"Choose two short stories whose openings are crafted to seize the reader’s attention. Explain in detail how the impact of the openings is created and go on to evaluate which of the stories develops more successfully from its opening.",
	"Choose a novel in which friendship or love is put to the test. Explain briefly how this situation arises and go on to discuss how the outcome of the test leads you to a greater understanding of the central concern(s) of the text.",
	"Choose a novel in which a central character is flawed but remains an admirable figure. Show how the writer makes you aware of these aspects of personality and discuss how this feature of characterisation enhances your appreciation of the text as a whole.",
	"Choose a novel or short story in which the writer explores feelings of rejection or isolation or alienation. Explain how the writer makes you aware of these feelings and go on to show how this exploration enhances your appreciation of the text as a whole.",
	"Choose a novel in which the narrative point of view is a significant feature in your appreciation of the text. Show how the writer’s use of this feature enhances your understanding of the central concern(s) of the text.",
	"Choose two short stories in which setting plays an important role in developing your understanding of character and/or theme. Which story, in your opinion, is more effective in developing your understanding? Justify your choice by reference to the setting of both stories.",
];

// Order 1
// $Markov->order = 4;

// Learn
foreach ($englishQuestions as $question){
	$Markov->learn($question);
}

$i = 0;
$generated = [];
$array = ['Choose a novel or short story in which there is an act of kindness or of compassion. Explain briefly the nature of the act and discuss its importance to your understanding of the character in the novel as a whole.'];

while($i < 1000){
	$asked = $Markov->ask();

	if(!in_array($asked, $englishQuestions) && !in_array($asked, $generated)){
		array_push($generated, $asked);
		echo "<div style='width: 50%;'>" . $asked . "</div><br>";
	}
	$i++;
}

// Choose a novel in which the narrative point of view is a significant feature in your appreciation of the text. Show how the writerâ€™s use of this feature enhances your understanding of the text as a whole. Show how the writer makes you aware of both aspects of the character.
// Choose a novel in which envy or malice or cruelty plays a significant part. Explain how the writer makes you aware of this aspect of the text and discuss how the writerâ€™s exploration of it enhances your understanding of the text as a whole. Show how the writer makes you aware of these aspects of personality and discuss how this feature of characterisation enhances your appreciation of the text as a whole. Show how the writer makes you aware of these aspects of personality and discuss how this feature of characterisation enhances your appreciation of the text as a whole. Show how the writer makes you aware of these feelings and go on to show how this exploration enhances your appreciation of the text as a whole. Show how the writer makes you aware of this aspect of the text and discuss how the writerâ€™s exploration of it enhances your understanding of the text as a whole. Show how the writer makes you aware of these aspects of personality and discuss how this feature of characterisation enhances your appreciation of the text as a whole. Show how the writer makes you aware of both aspects of the character.

?>

</body>
</html>