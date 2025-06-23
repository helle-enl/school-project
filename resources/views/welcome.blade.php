<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/index.css" />
    <style>
        * {
            padding: 0px;
            margin: 0px;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            /* margin: 0; */
            padding: 0px 0px;
        }

        .setup {
            background-image: url(../images/RAW\ COCOA\ 1.jpg);
            /* height: 600px; */
            background-position: center;
            background-size: cover;
            background-blend-mode: darken;
            background-color: rgba(51, 49, 49, 0.629);
            /* padding: 0px 20px; */
            background-repeat: no-repeat;
        }

        .holdiv {
            background-color: #4CAF50;
            color: white;
            padding: 20px 0px 0px 20px;
            /* display: flex; */
            align-items: center;
            /* justify-content: space-between; */

        }

        nav {
            display: flex;
            justify-content: space-between;
            /* background-color: #4CAF50; */
            padding: 20px 0px 20px 0px;
            /* text-align: center; */
            align-items: center;
        }

        .left {
            display: flex;
            align-items: center;
            gap: 30px;

        }

        .logos {
            font-size: 28px;
        }

        .holdbutt {
            display: flex;
            gap: 15px;
            padding: 10px;
        }

        .butt {
            outline: none;
            border: none;
            color: white;
            font-size: 20px;
            background: none;
            display: flex;
            gap: 10px;
            cursor: pointer;

        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #4CAF50;
            min-width: 220px;
            padding: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 5px;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content p {
            text-decoration: none;
            color: white;
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
        }

        .dropdown-content p:hover {
            color: black
        }

        .logsign {
            padding: 0px 50px 0px 0px;
            display: flex;
            gap: 15px;
            color: white;
        }

        .inup {
            background-color: red;
            padding: 9px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            /* display: flex; */

        }

        h5 {
            font-size: 20px;
            padding: 5px;
        }

        .hhh5 {
            padding: 10px 0px 10px 0px;
            margin: 30px 0px 30px 0px;
            color: white;
            background-color: #4CAF50;
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 0px 10px 10px 10px;
        }

        .grow {
            text-align: center;
            color: whitesmoke;
            font-size: 2.5rem;
            margin: 0px 0px 20px 0px;
        }

        .To-do {
            text-decoration: none;
            color: red;
        }

        .todo {
            display: flex;
            justify-content: space-between;

        }

        .farm-mage {
            height: 120px;
        }

        .mage-hold {
            display: flex;
            flex-direction: column;
            gap: 50px;
        }

        #coco {
            /* height: 150px; */
            width: 200px;
        }

        .farmer-sec {
            display: flex;
            padding: 0px 0px 0px 10px;
            justify-content: space-between;
            /* gap: 60px; */

        }

        .p-side {
            background-color: #4CAF50;
            padding: 20px 10px 0px 10px;
            width: 550px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            /* height: 300px; */
        }

        .p-write {
            color: white;
            font-size: 20px;
            gap: 10px;
        }

        .set-up2 {
            padding: 30px 0px 0px 0px;
            background-image: url(../images/buying\ and\ selling\ 2.avif);
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            background-blend-mode: darken;
            background-color: rgba(51, 49, 49, 0.629);

        }

        .front {
            text-align: center;
            color: whitesmoke;
            font-size: 2.0rem;
            margin: 0px 0px 20px 0px;
        }

        .get {

            font-size: 20px;
            color: #fff;
            background-color: #2C6B2F;
            text-decoration: none;
            border-radius: 5px;
            padding: 10px 300px 10px 10px;
        }

        .hold-sign {
            /* background-color: red; */
            text-align: center;
            margin: 30px 0px 0px 0px;


        }
    </style>
</head>

<body>
    <div class="container">
        <section class="setup">
            <!-- <img src="RAW COCOA 1.jpg" alt="" /> -->
            <div class="holdiv">
                <nav>
                    <div class="left">
                        <h1 class="logos">FARMCONNECT Nigeria</h1>
                        <div class="holdbutt">
                            <div class="dropdown">
                                <button class="butt">BUYHERE</button>
                                <div class="dropdown-content">
                                    <p>
                                        Welcome to the marketplace for premium cash crops. Here,
                                        you can browse and purchase directly from trusted farmers
                                        growing high-quality crops like cashew, coffee, cocoa, and
                                        cotton etc. Whether you're a local buyer or wholesaler,
                                        our platform connects you to reliable sources with fair
                                        prices and fresh harvests.
                                    </p>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="butt">SELLHERE</button>
                                <div class="dropdown-content">
                                    <p>
                                        Ready to sell your cash crops? Our platform makes it easy
                                        for farmers to reach serious buyers looking for quality
                                        harvests. Whether you're offering cashew, cocoa, cotton,
                                        or coffee,etc. you can list your crops, set your own
                                        price, and manage your sales—all in one place.
                                    </p>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="butt">PAYMENTMETHOD</button>
                                <div class="dropdown-content">
                                    <p>
                                        For now, all payments are made directly to the farmer
                                        after confirming the purchase. We do not process any
                                        payments through the platform. Buyers and sellers are
                                        encouraged to agree on secure, convenient payment
                                        arrangements such as cash, mobile money, or bank transfer.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="logsign">
                        <a class="inup" href="login.html">LOGIN</a>
                        <a class="inup" href="signup.html">SIGN UP</a>
                    </div>
                </nav>
            </div>
            <div class="hhh5">
                <h5>Farmer Section</h5>
                <div class="todo">
                    <a class="To-do" href="">Sell your cash crop here</a>
                    <a class="To-do" href="">List product</a>
                    <a class="To-do" href="">Add location</a>
                    <a class="To-do" href="">Add price </a>
                    <a class="To-do" href="">Add quantity</a>
                    <a class="To-do" href="">Add description</a>
                </div>
            </div>
            <div class="grow">
                <h2>Grow and Sell Your Cash Crops Directly to Buyers</h2>
            </div>
            <div class="farmer-sec">
                <div class="p-side">
                    <p class="p-write">
                        Sell your cash crops directly to buyers and get fair prices for
                        your harvest.
                    </p>
                    <p class="p-write">
                        Reach more buyers and sell your cash crops at fair, competitive
                        prices.
                    </p>
                    <p class="p-write">
                        Connect with local buyers and secure the best prices for your cash
                        crops.
                    </p>
                    <p class="p-write">
                        Maximize your profit by selling your cash crops directly to
                        trusted buyers.
                    </p>
                </div>
                <div class="mage-hold">
                    <div>
                        <img class="farm-mage" src="assets/images/laugh 2.jpg" alt="" />
                        <img class="farm-mage" src="assets/images/cocoa home.jpg" id="coco" alt="" />
                    </div>
                    <div>
                        <img class="farm-mage" src="assets/images/laugh image la.jpg" alt="" />
                        <img class="farm-mage" src="assets/images/laugh image.jpg" id="coco" alt="" />
                    </div>
                </div>
            </div>
        </section>
        <section class="set-up2">
            <div class="hhh5">
                <h5>Buyer Section</h5>
                <div class="todo">
                    <a class="To-do" href="">Search for your cash crop here</a>
                    <a class="To-do" href="">Contact farmer</a>
                    <a class="To-do" href="">Choose location</a>
                    <a class="To-do" href="">Choose quantity</a>
                    <a class="To-do" href="">Product details</a>
                    <a class="To-do" href="">Payment option</a>
                </div>
            </div>
            <div class="grow">
                <h2 class="front">
                    Buy premium cash crops directly from local farmers at fair prices—no
                    middlemen, just quality.
                </h2>
            </div>
            <div class="farmer-sec">
                <div class="p-side">
                    <p class="p-write">
                        Buy high-quality cash crops directly from farmers at fair,
                        transparent prices.
                    </p>
                    <p class="p-write">
                        Access verified farmers and secure the best quality crops for your
                        business.
                    </p>
                    <p class="p-write">
                        Connect with trusted farmers and source crops without middlemen.
                    </p>
                    <p class="p-write">
                        Build long-term partnerships with farmers and ensure consistent
                        crop supply.
                    </p>
                </div>
                <div class="mage-hold">
                    <div>
                        <img class="farm-mage" src="assets/images/cashew-tree.webp" alt="" />
                        <img class="farm-mage" src="assets/images/buy.png" id="coco" alt="" />
                    </div>
                    <div>
                        <img class="farm-mage" src="assets/images/happy smiling.webp" alt="" />
                        <img class="farm-mage" src="assets/images/cocoa pic.jpg" id="coco" alt="" />
                    </div>
                </div>
            </div>
            <div class="hold-sign">
                <a href="signup.html" class="get">Get Started</a>
            </div>
        </section>
    </div>
</body>

</html>
