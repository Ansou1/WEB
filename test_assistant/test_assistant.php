<!DOCTYPE html>
<html>
<body>

<?php

abstract class AHero
{
    protected $name;
    protected $hp;

    public function __construct($name, $hp=100)
    {
        $this->name = $name;
        $this->hp = $hp;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getHP()
    {
        return $this->hp;
    }
    
    public function setName($name)
    {
        if (is_string($name) && strlen($name) > 0)
            $this->name = $name;
    }

    public function setHP($hp)
    {
        if (is_int($hp) && $hp > 0)
        {
            $this->hp = (int)$hp;
        }
    }

    public function isDead()
    {
        return $this->hp === 0;
    }

    public function __toString()
    {
        return "I'm a hero, my name is [$this->name] and I've [$this->hp] hp";
    }

    abstract public function whoAmI();
}

interface ISupport 
{
    public function healHero($hero);
    public function setHeal($value);
    public function getHeal();
}

interface IDPS
{
    public function hitHero($hero);
    public function setDMG($value);
    public function getDMG();
}

final class Warrior extends AHero implements IDPS
{
    const MAX_HP = 200;
    const BASIC_DMG = 10;
    private $_dmg;

    public function __construct($name)
    {
        parent::__construct($name, self::MAX_HP);
        $this->_dmg = self::BASIC_DMG;
    }

    public function hitHero($hero)
    {
        $hp = $hero->getHP();
        $hp = $hp - $_dmg;
        $hero->setHP($hp);
        return ($hp > 0);
    }

    public function setDMG($value)
    {
        if ($value > 0)
        {
            $this->_dmg = $value;
        }
    }

    public function getDMG()
    {
        return $this->_dmg;
    }

    public function whoAmI()
    {
        echo "I'm a warrior and I love to fight!\n";
    }

    public function __toString()
    {
        return "I'm a warrior hero and my name is [$this->name] and I've [$this->hp] hp";
    }
}

final class Rogue extends AHero implements IDPS
{
    const MAX_HP = 150;
    const BASIC_DMG = 12;
    private $_dmg;

    public function __construct($name)
    {
        parent::__construct($name, self::MAX_HP);
        $this->_dmg = self::BASIC_DMG;
    }

    public function hitHero($hero)
    {
        $hp = $hero->getHP();
        $hp = $hp - $_dmg;
        $hero->setHP($hp);
        return ($hp > 0);
    }

    public function setDMG($value)
    {
        if ($value > 0)
        {
            $this->_dmg = $value;
        }
    }

    public function getDMG()
    {
        return $this->_dmg;
    }

    public function whoAmI()
    {
        echo "I'm a rogue and I love to fight!\n";
    }

    public function __toString()
    {
        return "I'm a rogue hero and my name is [$this->name] and I've [$this->hp] hp";
    }
}

final class Priest extends AHero implements ISupport
{
    const MAX_HP = 150;
    const BASIC_HEAL = 12;
    private $_heal;

    public function __construct($name)
    {
        parent::__construct($name, self::MAX_HP);
        $this->_heal = self::BASIC_HEAL;
    }

    public function whoAmI()
    {
        echo "I'm a priest and I want to heal everyone!\n";
    }

    public function healHero($hero)
    {
        $hp = $hero->getHP();
        $hp = $hp + $this->_heal;
        if ($hp <= $hero::MAX_HP)
        {
            $hero->setHP($hp);
            return true;
        }
        return false;
    }

    public function setHeal($value)
    {
        if ($value > 0)
        {
            $this->_heal = $value;
        }
    }

    public function getHeal()
    {
        return (int)($this->_heal);
    }
}

final class Receptarier extends AHero implements ISupport,IDPS
{
    const MAX_HP = 230;
    const BASIC_DMG = 18;
    const BASIC_HEAL = 17;
    private $_dmg;
    private $_heal;

    public function __construct($name)
    {
        parent::__construct($name, self::MAX_HP);
        $this->_dmg = self::BASIC_DMG;
        $this->_heal = self::BASIC_HEAL;
    }

    public function whoAmI()
    {
        echo "I'm a receptarier and I want to save everyone!\n";
    }

    public function healHero($hero)
    {
        $hp = $hero->getHP();
        $hp = $hp + $this->_heal;
        if ($hp <= $hero::MAX_HP)
        {
            $hero->setHP($hp);
            return true;
        }
        return false;
    }

    public function setHeal($value)
    {
        if ($value > 0)
        {
            $this->_heal = $value;
        }
    }

    public function getHeal()
    {
        return (int)($this->_heal);
    }

    public function hitHero($hero)
    {
        $hp = $hero->getHP();
        $hp = $hp - $this->_dmg;
        $hero->setHP($hp);
        return ($hp > 0);
    }

    public function setDMG($value)
    {
        if ($value > 0)
        {
            $this->_dmg = $value;
        }
    }

    public function getDMG()
    {
        return $this->_dmg;
    }
}

final class Shaman extends AHero implements ISupport,IDPS
{
    const MAX_HP = 200;
    const BASIC_DMG = 15;
    const BASIC_HEAL = 15;
    private $_dmg;
    private $_heal;

    public function __construct($name)
    {
        parent::__construct($name, self::MAX_HP);
        $this->_dmg = self::BASIC_DMG;
        $this->_heal = self::BASIC_HEAL;
    }

    public function whoAmI()
    {
        echo "I'm a shaman and I want to save everyone!\n";
    }

    public function healHero($hero)
    {
        $hp = $hero->getHP();
        $hp = $hp + $this->_heal;
        if ($hp <= $hero::MAX_HP)
        {
            $hero->setHP($hp);
            return true;
        }
        return false;
    }

    public function setHeal($value)
    {
        if ($value > 0)
        {
            $this->_heal = $value;
        }
    }

    public function getHeal()
    {
        return (int)($this->_heal);
    }

    public function hitHero($hero)
    {
        $hp = $hero->getHP();
        $hp = $hp - $this->_dmg;
        $hero->setHP($hp);
        return ($hp > 0);
    }

    public function setDMG($value)
    {
        if ($value > 0)
        {
            $this->_dmg = $value;
        }
    }

    public function getDMG()
    {
        return $this->_dmg;
    }
}

class ParseFile
{

    //singleton
    private static $_instance = null;

    private $tab_hero = array();

    private function __construct() {}

    //singleton : retour de l'instance de la classe
    public static function getInstance()
    {
        if (is_null(self::$_instance))
        {
            self::$_instance = new ParseFile();
        }
        return self::$_instance;
    }

    //file_value doit être check avec === false
    public function getContentFile($path)
    {
        $file_value = file_get_contents($path);
        if ($file_value === false)
        {
            throw new Exception("Error occured.");
        }
        return $file_value;
    }

     /*
    J'ai fais une copie en soit de getHeroesFromFile
    Que j'ai adapter, le code n'est pas propre
    Je n'ai pas eu le temps de check les erreurs
    */

    //file_vla doit être check avec === false
    public function getHeroesFromFileXML($path)
    {
        $file_value_xml=simplexml_load_file($path) or die("Error: Cannot create object");
        if ($file_value_xml === false) 
        {
            throw new Exception("Error occured 1.");
        }

        foreach($file_value_xml->children() as $hero)
        {
            $type = (string)$hero['type'];
            $name = (string)$hero->name;
            $domage = (string)$hero->domage;
            $heal = (string)$hero->heal;

            $type = trim($type);
            $name = trim($name);
            $domage = trim($domage);
            $heal = trim($heal);

            $new_hero = null;

            if (!class_exists($type))
            {
                throw new Exception("Error occured 3.");
            }

            try 
            {
                $new_hero = new $type($name);
            }
            catch (Exception $e)
            {
                throw new Exception("Error occured 3.");
            }

            if (get_class($new_hero) === "Warrior" || get_class($new_hero) === "Rogue" || get_class($new_hero) === "Shaman" || get_class($new_hero) === "Receptarier")
            {
                //Gestion "Error occured 4." dans le cas, n'a pas cette caractéristique 
                if (!method_exists($new_hero, "setDMG"))
                {
                    throw new Exception("Error occured 4.");
                }
                else
                {
                    //cast en int dans le cas d'un double qui est passé par is_numeric
                    $new_hero->setDMG((int)$hero->domage);
                }
            }

            if (get_class($new_hero) === "Priest" || get_class($new_hero) === "Shaman" || get_class($new_hero) === "Receptarier")
            {
                //Gestion "Error occured 4." dans le cas, n'a pas cette caractéristique
                if (!method_exists($new_hero, "setHeal"))
                {
                    throw new Exception("Error occured 4.");
                }
                else
                {
                    //cast en int dans le cas d'un double qui est passé par is_numeric
                    $new_hero->setHeal((int)$hero->heal);
                }
            }
            //print_r($new_hero);
        }
    }

    public function getHeroesFromFile($path)
    {
        //Gestion "Error occured 1." après récupération du fichier
        $file_value = file_get_contents($path);
        if ($file_value === false)
        {
            throw new Exception("Error occured 1.");
        }

        /*
            Découpe du fichier par ligne puisque chaque ligne est séparé par \n
            Chaque ligne représente un personnage
            Boucle sur chaque ligne afin de créer le personnage
            retour du/des héro(s) créer
        */
        
        $lines = explode("\n", $file_value);
        
        foreach ($lines as $line)
        {
            //Découpe de la ligne à chaque espace
            $word_tab = explode(' ', $line);

            //Gestion "Error occured 2." dans le cas, moins de 2 mots
            if (count($word_tab) < 2)
            {
                throw new Exception("Error occured 2.");
            }

            /*
                création d'un "objet" hero qu'on set à null
                On sait que tout les mot de la ligne sont découpé dans le tableau word_tab
                La première valeur est la classe donc check si la classe existe
                //Gestion "Error occured 3." dans le cas, la classe n'existe pas et la classe n'est pas final
            */

            $hero = null;
            $class_hero = $word_tab[0];
            if (!class_exists($class_hero))
            {
                throw new Exception("Error occured 3.");
            }

            //Gestion "Error occured 3." dans le cas, la classe n'est pas instantiable
            try 
            {
                $hero = new $class_hero($word_tab[1]);
            }
            catch (Exception $e)
            {
                throw new Exception("Error occured 3.");
            }

            //Boucle de gestion: "* = ce pattern ([letter:number]) peut être répété 0 ou plus"
            $number_of_words = count($word_tab);
            for ($i = 2; $i < $number_of_words; $i++)
            {
                //Découpe de chaque mot au ":" puisque [letter:number]
                $value_letter_number = explode(':', $word_tab[$i]);

                //Nettoyage: ne marche pas sans ça dans mes tests
                $value_letter_number[0] = trim($value_letter_number[0]);
                $value_letter_number[1] = trim($value_letter_number[1]);
                //Gestion "Error occured 4." dans le cas, mauvaise lettre / n'est pas un nombre
                if (($value_letter_number[0] !== 'd' && $value_letter_number[0] !== 'h') || !is_numeric($value_letter_number[1]))
                {
                    throw new Exception("Error occured 4.");
                }

                if ($value_letter_number[0] === 'd')
                {
                    //Gestion "Error occured 4." dans le cas, n'a pas cette caractéristique 
                    if (!method_exists($hero, "setDMG"))
                    {
                        throw new Exception("Error occured 4.");
                    }
                    else
                    {
                        //cast en int dans le cas d'un double qui est passé par is_numeric
                        $hero->setDMG((int)$value_letter_number[1]);
                    }
                } 
                else 
                {
                    //Gestion "Error occured 4." dans le cas, n'a pas cette caractéristique
                    if (!method_exists($hero, "setHeal"))
                    {
                        throw new Exception("Error occured 4.");
                    }
                    else
                    {
                        //cast en int dans le cas d'un double qui est passé par is_numeric
                        $hero->setHeal((int)$value_letter_number[1]);
                    }
                }
            }
            $tab_hero[] = $hero; //add ici du hero ajouter dans array
        }
       return $tab_hero;
    }
}

//print_r(ParseFile::getInstance()->getHeroesFromFile("fichier1.txt"));
//ParseFile::getInstance()->getHeroesFromFileXML("test_xml.xml");

?>

</body>
</html>