<?php

require_once dirname(__FILE__).'/AppComponent.php';

/**
 * Little Helper class that can extract keywords from texts
 *
 * This little Component can help you extract Keywords or Tag values from a
 * text using a simple scoring/occurence count system. You can modify the scores
 * given for word lengths, or all-uppercase words.
 *
 * Usually the longest word or word-pair combination that occures the most and
 * is even uppercase would be the best and first result.
 *
 * @subpackage harrison.lib
 * @package harrison
 * @author Ephigenia // Marcel Eichner <love@ephigenia.de>
 * @since 30.01.2009
 */
class SEOKeywords extends AppComponent {
	
	/**
	 *	Bonus score for words written in CAPITAL letters
	 * 	@var integer
	 */
	public $capitalLetterBonus = 2;
	
	/**
	 *	Bonus for n-length words
	 * 	@var array(float)
	 */
	public $lengthBonus = array(
		6 	=> .25,
		7 	=> .5,
		8 	=> .75,
		9 	=> 1.25,
		10 	=> 1.3,
		11	=> 1.35,
		12	=> 1.4
	);
	
	public $collectPairs = true;
	
	public $useStopWords = true;
	
	public $stopWords = 'aber,alle,allem,allen,aller,alles,als,also,am,an,ander,andere,anderem,anderen,anderer,anderes,anderm,andern,anders,auch,auf,aus,bei,bin,bis,bist,da,dadurch,daher,damit,dann,darum,das,dass,dasselbe,dazu,daß,dein,deine,deinem,deinen,deiner,deines,dem,demselben,den,denn,denselben,der,derer,derselbe,derselben,des,deshalb,desselben,dessen,dich,die,dies,diese,dieselbe,dieselben,diesem,diesen,dieser,dieses,dir,doch,dort,du,durch,ein,eine,einem,einen,einer,eines,einig,einige,einigem,einigen,einiger,einiges,einmal,er,es,etwas,euch,euer,eure,eurem,euren,eurer,eures,fÃŒr,für,gegen,gewesen,hab,habe,haben,hat,hatte,hatten,hattest,hattet,hier,hin,hinter,ich,ihm,ihn,ihnen,ihr,ihre,ihrem,ihren,ihrer,ihres,im,in,indem,ins,ist,ja,jede,jedem,jeden,jeder,jedes,jene,jenem,jenen,jener,jenes,jetzt,kann,kannst,kein,keine,keinem,keinen,keiner,keines,können,könnt,könnte,machen,man,manche,manchem,manchen,mancher,manches,mein,meine,meinem,meinen,meiner,meines,mich,mir,mit,muss,musst,musste,muß,mußt,müssen,müßt,nach,nachdem,nein,nicht,nichts,noch,nun,nur,ob,oder,ohne,sehr,seid,sein,seine,seinem,seinen,seiner,seines,selbst,sich,sie,sind,so,solche,solchem,solchen,solcher,solches,soll,sollen,sollst,sollt,sollte,sondern,sonst,soweit,sowie,um,und,uns,unse,unsem,unsen,unser,unsere,unses,unter,viel,vom,von,vor,wann,war,waren,warst,warum,was,weg,weil,weiter,weitere,welche,welchem,welchen,welcher,welches,wenn,wer,werde,werden,werdet,weshalb,wie,wieder,wieso,will,wir,wird,wirst,wo,woher,wohin,wollen,wollte,während,würde,würden,zu,zum,zur,zwar,zwischen,über';
	
	/**
	 * Extract Keywords from a text and return $num of them
	 *
	 * @param string $text
	 * @param integer $num
	 * @return array(string)
	 */
	public function extract($text, $num = null)
	{
		// strip html
		$text = strip_tags($text);
		// strip stopwords
		if ($this->useStopWords) {
			$text = $this->stripStopWords($text);
		}
		// extract long words
		if ($this->collectPairs) {
			$regexp = '@([A-Z][a-z]{4,}|[A-Z]{3,})([\s-][A-Z][a-z]{3,})?@';
		} else {
			$regexp = '@([A-Z][a-z]{4,}|[A-Z]{3,})@';
		}
		if (!preg_match_all($regexp, $text, $found)) {
			return array();
		}
		// count occurences that are used as basic score
		foreach($found[0] as $word) {
			if (!isset($keywords[$word])) {
				$keywords[$word] = 1;
			}
			$keywords[$word]++;
		}
		// extra scoring for word lengths and upper case words
		if (!empty($this->lengthBonus)) {
			$lastWordLengthBonusKey = array_keys($this->lengthBonus);
			$lastWordLengthBonusKey = end($lastWordLengthBonusKey);
		}
		foreach($keywords as $word => $count) {
			// word length bonus
			if (!empty($this->lengthBonus)) {
				$wordLength = String::length($word);
				if (isset($this->lengthBonus[$wordLength])) {
					$keywords[$word] += $this->lengthBonus[$wordLength];
				}
				if ($wordLength > $this->lengthBonus[$lastWordLengthBonusKey]) {
					$keywords[$word] *= 1.5;
				}
			}
			// capital letters bonus
			if (preg_match('@^[A-Z]+$@', $word)) {
				$keywords[$word] += $this->capitalLetterBonus;
			}
		}
		// sort by score
		arsort($keywords);
		if ($num !== null) {
			$keywords = array_slice($keywords, 0, $num);
		}
		return array_keys($keywords);
	}
	
	/**
	 * 	Strips all stopwords from a text
	 * 	@param string	$text
	 * 	@return string
	 */
	public function stripStopWords($text)
	{
		$stopWords = explode(',', $this->stopWords);
		foreach($stopWords as $stopWord) {
			$stopWordQuoted = preg_quote($stopWord, '@');
			$text = preg_replace('@(^'.$stopWordQuoted.'|\s+'.$stopWordQuoted.')([\s.!?]+)@i', ' ', $text);
		}
		return $text;	
	}
}