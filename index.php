<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        button {
            position: relative;
            display: inline-block;
            cursor: pointer;
            outline: none;
            border: 0;
            vertical-align: middle;
            text-decoration: none;
            background: transparent;
            padding: 0;
            font-size: inherit;
            font-family: inherit;
        }

        button.dashboard {
            width: 12rem;
            height: auto;
        }

        button.dashboard .circle {
            transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
            position: relative;
            display: block;
            margin: 0;
            width: 3rem;
            height: 3rem;
            background: #46abcc;
            border-radius: 1.625rem;
        }

        button.dashboard .circle .icon {
            transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
            position: absolute;
            top: 0;
            bottom: 0;
            margin: auto;
            background: #fff;
        }

        button.dashboard .circle .icon.arrow {
            transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
            left: 0.625rem;
            width: 1.125rem;
            height: 0.125rem;
            background: none;
        }

        button.dashboard .circle .icon.arrow::before {
            position: absolute;
            content: "";
            top: -0.29rem;
            right: 0.0625rem;
            width: 0.625rem;
            height: 0.625rem;
            border-top: 0.125rem solid #fff;
            border-right: 0.125rem solid #fff;
            transform: rotate(45deg);
        }

        button.dashboard .button-text {
            transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            padding: 0.75rem 0;
            margin: 0 0 0 1.85rem;
            color: #46abcc;
            font-weight: 700;
            line-height: 1.6;
            text-align: center;
            text-transform: uppercase;
        }

        button:hover .circle {
            width: 100%;
        }

        button:hover .circle .icon.arrow {
            background: #fff;
            transform: translate(1rem, 0);
        }

        button:hover .button-text {
            color: #fff;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #252525;
        }

        .navbar {
            background-color: #525151;
            overflow: hidden;
        }

        .navbar ul {
            display: flex;
            justify-content: space-between;
            list-style: none;
        }

        .navbar ul li .x1 {
            float: left;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar ul li .x1:hover {
            background-color: #111;
        }

        .navbar .active {
            background-color: #4CAF50;
        }
        a{
            text-decoration: none;
        }

    </style>
   <link rel="shortcut icon" type="image/png" href="assets/logo.png"/>

</head>

<body>
    <div class="navbar">
        <ul>
            <li><a class="x1 active" href="#">Home</a>

                <a class="x1" href="#">About</a>
                <a class="x1" href="#">Services</a>
                <a class="x1" href="#">Contact</a>
            </li>
            <li>
                <button class="dashboard" href="login_form.php">
                    <span class="circle" aria-hidden="true">
                        <span class="icon arrow"></span>
                    </span>
                   <a  href="login_form.php" class="button-text">Dashboard</a>
                </button>
            </li>
        </ul>
    </div>

</body>

</html>
