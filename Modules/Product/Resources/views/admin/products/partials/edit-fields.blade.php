<div class="box-body">
    <div class='form-group{{ $errors->has('name') ? ' has-error' : '' }}'>
        {!! Form::label('name', trans('product::products.form.name')) !!}
        {!! Form::text('name', old('name',$product->name), ['class' => 'form-control', 'placeholder' => trans('product::products.form.name')]) !!}
        {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has('price') ? ' has-error' : '' }}'>
        {!! Form::label('price', trans('product::products.form.price')) !!}
        {!! Form::number('price', old('price',$product->price), ['class' => 'form-control', 'placeholder' => trans('product::products.form.price')]) !!}
        {!! $errors->first('price', '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has('description') ? ' has-error' : '' }}'>
        {!! Form::label('description', trans('product::products.form.description')) !!}
        {!! Form::textarea('description', old('description',$product->description), ['class' => 'form-control', 'placeholder' => trans('product::products.form.description')]) !!}
        {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
    </div>
    {!! Form::hidden('productImage',trans('product::products.form.image'), []) !!}
</div>
