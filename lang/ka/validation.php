<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'max' => [
        'array' => ':attribute ველში არ უნდა იყოს :max ერთეულზე მეტი.',
        'file' => ':attribute ველი არ უნდა იყოს :max კილობაიტზე მეტი.',
        'numeric' => ':attribute ველი არ უნდა იყოს :max-ზე მეტი.',
        'string' => ':attribute ველი არ უნდა იყოს :max სიმბოლოზე მეტი.',
    ],
    'min' => [
        'array' => ':attribute ველში უნდა იყოს მინიმუმ :min ელემენტი.',
        'file' => ':attribute ველი უნდა იყოს მინიმუმ :min კილობაიტზე.',
        'numeric' => ':attribute ველი უნდა იყოს მინიმუმ :min.',
        'string' => ':attribute ველი უნდა იყოს მინიმუმ :min სიმბოლო.',
    ],
    'required' => ':attribute ველი აუცილებელია.',
    'string' => ':attribute ველი უნდა იყოს სტრიქონი.',
    'unique' => ':attribute უკვე დაკავებულია.',
    'alpha' => ':attribute ველი უნდა შეიცავდეს მხოლოდ ასოებს.',
    'alpha_dash' => ':attribute ველი უნდა შეიცავდეს მხოლოდ ასოებს, რიცხვებს, ტირეებს და ქვედა ხაზებს.',
    'alpha_num' => ':attribute ველი უნდა შეიცავდეს მხოლოდ ასოებსა და ციფრებს.',
    'required_without' => ':attribute ველი საჭიროა, როცა :values არ არის შეყვანილი',

    'attributes' => [
        'name' => 'სახელწოდება',
        'slug' => 'ლინკი',
        'email' => 'ელ-ფოსტა',
        'description' => 'აღწერა',
        'password' => 'პაროლი',
        'start_date' => 'დაწყების თარიღი',
        'end_date' => 'დასრულების თარიღი',
    ],


];
