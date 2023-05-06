<?php

//Класс работает при помощи класса, разработанного в задании 1.
require_once (__DIR__.'/PeopleDB.php');

// TODO В файле со 2ым классом должна проходить проверка на наличие первого класса. (сделать обработчик)
// TODO Если класс отсутствует вывести ошибку и не объявлять класс 2.

//БД содержит поля: id, имя(только буквы), фамилия(только буквы), дата рождения, пол(0,1), город рождения.
//Класс имеет Массив с id людей.

class PeopleList
{
    function __construct()
    {
        echo '<br>';
        $sql = "SELECT * FROM people";
        if ($result = $GLOBALS['conn']->query($sql)) {
            foreach ($result as $row) {
                $arr[] = $row['id'];
            }
            $this -> $arr;
        }else{
            echo "Возникла ошибка: " . $GLOBALS['conn']->error;
        }
    }

    //Класс должен иметь методы:
    //Конструктор ведет поиск id людей по всем полям БД (поддержка выражений больше, меньше, не равно);
    //Получение массива экземпляров класса 1 из массива с id людей полученного в конструкторе;

    public function searchArrPeople($people)
    {
        for ($i=0; $i < count($people->arrId); $i++) {
            $person = new person($people->arrId[$i], '', '', '', '', '');
            $arrPerson[] = $person;
        }
        return $arrPerson;
    }

    //Удаление людей из БД с помощью экземпляров класса 1 в соответствии с массивом, полученным в конструкторе.
    public function delArrPeople($people)
    {
        for ($i = 0; $i < count($people->arrId); $i++) {
            $id = intval($people->arrId[$i]);
            $sql = "DELETE FROM people WHERE id='$id'";
            if ($GLOBALS['conn']->query($sql)) {
                echo '<br>';
                echo 'Строка с id '. $id .' удалена';
            } else {
                echo "Возникла ошибка: " . $GLOBALS['conn']->error;
            }
        }
    }
}
