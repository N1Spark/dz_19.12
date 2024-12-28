<?php
namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function registration()
    {
        if ($this->request->getMethod() === 'POST') {
            $name = $this->request->getPost('name');
            $email = $this->request->getPost('email');
            log_message('debug', 'Отримано дані: Name - ' . $name . ', Email - ' . $email);

            $file = 'public\uploads\registration_data.txt';
            $data = "Name: $name, Email: $email\n";

            if (file_put_contents('../'.$file, $data, FILE_APPEND) === false) {
                log_message('error', 'Не вдалося записати у файл: ' . $file);
                return redirect()->to('/registration')->with('error', 'Помилка запису даних!');
            }
            return redirect()->to('/registration')->with('message', 'Дані збережено успішно!');
        }

        return view('registration_form');
    }
}
