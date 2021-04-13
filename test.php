<?php


// 1.	Создать класс Item, который не наследуется. В конструктор класса передается ID объекта.
// 2.	Описать свойства (int) id, (string) name, (int) status, (bool) changed.
// Свойства доступны только внутри класса.
// 3.	Создать метод init(). Предусмотреть одноразовый вызов метода.
// 4.	Метод доступен только внутри класса.
// 5.	Метод получает из таблицы objects данные name и status и заполняет их в свойства
// экземпляра (реализация работы с базой не требуется, представим что класс уже работает с бд).
// Эти данные также необходимо хранить в сыром виде внутри объекта, до сохранения.
// 6.	Сделать возможным получение свойств объекта, используя magic methods.
// 7.	Сделать возможным задание свойств объекта, используя magic methods с проверкой
// вводимого значения на заполненность и тип значения. Свойство ID не поддается записи.
// 8.	Создать метод save().
// 9.	Метод публичный.
// 10.	Метод сохраняет установленные значения name и status в случае, если свойства объекта
// были изменены извне.
// 11.	Класс должен быть задокументирован в стиле PHPDocumentor.




final class Item {

  private int $id;
  private string $name;
  private int $status;
  private bool $changed;

  function __construct($idnew)
  {
    $this ->id = $idnew;
  }

  private static function init($name_get, $status_get) {
    $this->name_get = $name;
    $this->status_get = $status;
  }

  public function __get($property) {
    if (property_exists($this, $property)) {
      return $this->$property;
    }
  }

  public function __set($property, $value)
  {
    if (property_exists($this, $property) && !(empty($value)) && $property!='changed') {
      switch($property) {
        case 'name':
          if (is_string($value)) {
            $this->$property = $value;
          }
        case 'status':
          if (is_int($value)) {
            $this->$property = $value;
          }
        default:
        break;
      }
      $this->$property = $value;
    }
  }

  public function save($name_send, $status_send) {
    if ($this->changed == false) {
      $this->name = $name_send;
      $this->status = $status_send;
      $this->changed = true;
    }
  }
}


// Есть несколько таблиц в БД: users, objects
// 1.	users: id, login, password, object_id
// 2.	objects: id, name, status
// Нужно сделать выборку пользователей из базы данных с использованием конструкции JOIN у которых есть запись в таблице objects, соответствующая значению object_id

$query = "SELECT * FROM users LEFT JOIN objects ON users.object_id = objects.id"

SELECT *
FROM users
LEFT JOIN objects
ON users.object_id = objects.id
