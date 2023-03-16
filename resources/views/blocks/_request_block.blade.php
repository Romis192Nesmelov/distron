<h2>Оставьте заявку</h2>
<form class="form col-12" action="">
    @include('blocks._input_block',[
        'name' => 'name',
        'label' => 'Ваше имя',
        'required' => true,
        'placeholder' => 'Ваше имя'
    ])
    @include('blocks._input_block',[
        'name' => 'email',
        'label' => 'Ваш E-mail',
        'required' => true,
        'placeholder' => 'Ваш E-mail'
    ])
    @include('blocks._input_block',[
        'name' => 'phone',
        'label' => 'Ваш телефон',
        'required' => true,
        'placeholder' => '+7(___)___-__-__'
    ])
    @include('blocks._checkbox_block',[
        'name' => 'i_agree',
        'label' => 'Даю согласие на обработку персональных данных'
    ])
    <button type="submit" class="btn btn-primary mb-4 col-3 float-end">Отправить</button>
</form>
