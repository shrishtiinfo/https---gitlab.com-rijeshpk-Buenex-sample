<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
			
			.addproduct a {
    width: 100%;
    height: 40px;
    background: #ff656c;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #e15960;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    font-family: Montserrat;
    outline: none;
    cursor: pointer;
	display:block;
	text-align:center;
	text-decoration:none;
	padding-top:10px;
	margin-top:10px;
}

.addproduct a:hover {
    background: #ff7b81;
}
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    Products
                </div>
	<div class="addproduct">
                    <a href="{{ url('/add_product') }}">Add Product</a>
					<a href="{{ url('/logout') }}">Logout</a>
                </div>

                <table>
					<thead>
						<th>#</th>
						<th>Name</th>
						<th>Description</th>
						<th>Price</th>
					</thead>
					<tbody>
					@if(count($model) > 0 )
						@foreach($model as $product)
							<tr>
								<td> {{ $product->id }} </td>
								<td> {{ $product->title }} </td>
								<td> {{ $product->description }} </td>
								<td> {{ $product->price }} </td>
							</tr>
						@endforeach;
						@endif
					</tbody>
				</table>
            </div>
        </div>
    </body>
</html>
