<?php

class PeopleDB
{
    //Класс должен иметь поля: id, имя, фамилия, дата рождения, пол(0,1), город рождения.
    public $id, $firstname, $lastname, $birthday, $sex, $city;

    function __construct($id, $firstname, $lastname, $birthday, $sex, $city)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->birthday = $birthday;
        $this->sex = $sex;
        $this->city = $city;
    }

    //TODO: Конструктор класса либо создает человека в БД с заданной информацией, либо берет информацию из БД по id

    //Сохранение полей экземпляра класса в БД;
    function savePeople()
    {
        $sql = "INSERT INTO people (id, firstname, lastname, birthday, sex, city) VALUES ('$this->id', '$this->firstname', '$this->lastname', '$this->birthday', '$this->sex', '$this->city')";

        if ($GLOBALS['conn']->query($sql)) {
            echo "Информация добавлена";
        } else {
            echo "Возникла ошибка: " . $GLOBALS['conn']->error;
        }
    }
    //(предусмотреть валидацию данных);


    //Удаление человека из БД в соответствии с id объекта;
    function delPeople()
    {
        $sql = "DELETE FROM people WHERE id = '$this->id'";

        if ($GLOBALS['conn']->query($sql)) {
            echo "Данные успешно удалены";
        } else {
            echo "Возникла ошибка: " . $GLOBALS['conn']->error;
        }
    }

    //static преобразование даты рождения в возраст (полных лет);
    public static function AgeOfPeople($person){
        $diff = date( 'Ymd' ) - date( 'Ymd', strtotime($person->birthday) );
        $obj = new stdClass();
        $obj->id = $person->city;
        $obj->firstname = $person->firstname;
        $obj->lastname = $person->lastname;
        $obj->birthday = substr( $diff, 0, -4 );
        $obj->sex = $person->sex;
        $obj->city = $person->city;
        return $obj;
    }

    //static преобразование пола из двоичной системы в текстовую (муж, жен);
    public static function switchSex( $person ){
        $obj = new stdClass();
        $obj->id = $person->city;
        $obj->firstname = $person->firstname;
        $obj->lastname = $person->lastname;
        $obj->birthday = $person->birthday;
        $obj->sex = $person->sex;
        if ($person->sex == 0) {
            $obj->sex = 'Муж';
        }else{
            $obj->sex = 'Жен';
        }
        $obj->city = $person->city;
        return $obj;
    }
    //Форматирование человека с преобразованием возраста и (или) пола (п.3 и п.4) в зависимости от параметров
    // (возвращает новый экземпляр stdClass со всеми полями изначального класса).
}