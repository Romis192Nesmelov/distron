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
    'label' => trans('content.i_agree')
])
