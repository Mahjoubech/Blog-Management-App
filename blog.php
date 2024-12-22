
<?php
 session_start();
include ("./src/datacnx.php");
//for display data category
 //Requets
 $sqldata= $cnx->query('SELECT * from category order by catId Asc');
 //Get values
 $category = $sqldata->fetch_all(MYSQLI_ASSOC);
//get data articles from database to blog page
$sql = $cnx->query('SELECT * ,user.username as name , category.name as catname  FROM article  join user on  article.userId = user.useId join category on article.categId = category.catId  order by art_Id desc ;');
$articles = $sql->fetch_all(MYSQLI_ASSOC);
//add article from user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addArt'])) {
    $user = $_SESSION['user']['useId'];
    $catg = $_POST['slectCat'];
    $title = $_POST['titleblog'];
    $img = $_POST['lienimage'];
    $desc = $_POST['descrp'];

    if (!empty($catg) && !empty($title) && !empty($img) && !empty($desc)) {
        // Insérer dans la base de données
        $query = $cnx->query("INSERT INTO `article` (`userId`, `title`, `content`, `image`, `categId`) 
                              VALUES ('$user', '$title', '$desc', '$img', '$catg')");
        if ($query) {
            header('Location: blog.php');
        } else {
            die("Erreur SQL : " . $cnx->error);
        }
    }
}
//delet category
if(isset($_GET['idArt'])){
    $artid = $_GET['idArt'];
    $delet = $cnx->prepare('DELETE FROM article WHERE art_Id=?');
    $delet->execute([$artid]);
 header('Location: blog.php');
 }

 //get value for edit
   //Get values
   if(isset($_GET['idArtedt'])){
   
       $id = $_GET['idArtedt'];
       $edit = "SELECT * FROM `article` WHERE art_Id = $id";
       $result = mysqli_query($cnx, $edit);
       $cos = mysqli_fetch_assoc($result);
       if(isset($cos)) {
           echo "<script>
               console.log(document.getElementById('articleFormedit'));
               document.addEventListener('DOMContentLoaded', () => {
                   document.getElementById('articleFormedit').classList.toggle('active');
               })
           </script>";
          
       }
   }
?>


 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="refresh" content="2"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Blog Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="tailwind.config.js"></script>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
     
    </script>
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-secondary text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <i class="fas fa-blog mr-2"></i>
                    <h1 class="text-xl font-bold">BlogPlatform</h1>
                </div>
                
                <div class="flex items-center space-x-4">
                <?php if(!isset($_SESSION['user'])){ ?>
                    <button id="loginBtn" class="text-neutral hover:text-white" hidden>
                       <a href="./logout.php"><i class="fas fa-sign-in-alt mr-1"></i>Logout</a> 
                    </button>
                    <?php }else{ ?>
                        <button id="loginBtn" class="text-neutral hover:text-white">
                       <a href="./logout.php"><i class="fas fa-sign-in-alt mr-1"></i>Logout</a> 
                    </button>
                    <?php } ?>
                    <button id="registerBtn" class="bg-primary text-white px-4 py-2 rounded hover:bg-opacity-90">
                       <a href="./singup.php"><i class="fas fa-user-plus mr-1"></i>Sign Up</a> 
                    </button>
                    <?php if(!isset($_SESSION['user'])){ ?>
                        <div class="adminicons" hidden>
                        <a href="dachboard.php"> <i class="fa-solid fa-user-tie"></i>
                             <h5>Dashboard</h5></a>
                             
                   
                </div>
                <?php }else{ ?>
                    <div class="adminicons">
                        <a href="dachboard.php"> <i class="fa-solid fa-user-tie"></i>
                             <h5>Dashboard</h5></a>
                             
                   
                </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Category Filter -->
        <div class="mb-8">
            <div class="flex space-x-4">
                <button class="bg-primary text-white px-4 py-2 rounded hover:bg-opacity-90 category-filter active">
                   All
                </button>
                <?php foreach($category as $catg){?>

                <button class="bg-neutral text-white px-4 py-2 rounded hover:bg-opacity-90 category-filter">
                    <?php echo $catg['name']?>
                </button>
                <?php } ?>
            </div>
        </div>

        <!-- Add Article Button -->
        <button id="addArticleBtn" class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-opacity-90 mb-8">
            <i class="fas fa-plus mr-2"></i>Add Article
        </button>

        <!-- Add Article Form -->
        <div id="articleForm" class="slide-down bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-2xl font-bold mb-4 text-secondary">
                <i class="fas fa-pen-to-square mr-2"></i>Create New Article
            </h2>
            <form method="post" action="blog.php">
                <div class="mb-4">
                    <label class="block text-secondary mb-2">
                        <i class="fas fa-heading mr-1"></i>Title
                    </label>
                    <input name="titleblogedt" type="text" class="w-full px-4 py-2 border rounded focus:outline-none focus:border-primary" required>
                </div>
                <div class="mb-4">
                    <label class="block text-secondary mb-2">
                        <i class="fas fa-tag mr-1"></i>Category
                    </label>
                    <select name="slectCatedt" class="w-full px-4 py-2 border rounded focus:outline-none focus:border-primary" required>
                    <option value="" disabled selected>Select category </option>
                    <?php foreach($category as $catg){?>
                    <option value="<?php echo $catg['catId']?>"><?php echo $catg['name']?></option>
                    <?php } ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-secondary mb-2">
                        <i class="fas fa-paragraph mr-1"></i>Content
                    </label>
                    <textarea name="descrpedt" class="w-full px-4 py-2 border rounded focus:outline-none focus:border-primary" rows="6" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-secondary mb-2">
                        <i class="fas fa-image mr-1"></i>Image
                    </label>
                    <input name="lienimageedt" type="text" class="w-full px-4 py-2 border rounded focus:outline-none focus:border-primary" required>
                </div>
                <button name="addArtedt" type="submit" class="bg-primary text-white px-6 py-2 rounded hover:bg-opacity-90">
                    <i class="fas fa-paper-plane mr-1"></i>Publish
                </button>
            </form>
        </div>

        <!-------------- Edit article format ------------------>
        <div id="articleFormedit" class="slide-down bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-2xl font-bold mb-4 text-secondary">
                <i class="fas fa-pen-to-square mr-2"></i>Update Article
            </h2>
            <form method="post" action="./admin/editblog.php?ideditart=<?php echo $cos['art_Id']?>">
                <div class="mb-4">
                    <label class="block text-secondary mb-2">
                        <i class="fas fa-heading mr-1"></i>New Title
                    </label>
                    <input name="titleblog" type="text" class="w-full px-4 py-2 border rounded focus:outline-none focus:border-primary"  value="<?php if(isset($cos['title'])) echo $cos['title']?>" >
                </div>
                <div class="mb-4">
                    <label class="block text-secondary mb-2">
                        <i class="fas fa-tag mr-1"></i>New Category
                    </label>
                    <select name="selectCat" class="w-full px-4 py-2 border rounded focus:outline-none focus:border-primary">
                    <option value="" disabled selected>Select category </option>
                    <?php foreach($category as $catg){?>
                    <option value="<?php echo $catg['catId']?>"><?php echo $catg['name']?></option>
                    <?php } ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-secondary mb-2">
                        <i class="fas fa-paragraph mr-1"></i>New Content
                    </label>
                    <textarea name="descrp" class="w-full px-4 py-2 border rounded focus:outline-none focus:border-primary" rows="6"><?php if(isset($cos['content'])) echo $cos['content']?></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-secondary mb-2">
                        <i class="fas fa-image mr-1"></i>New Image
                    </label>
                    <input name="lienimage" type="text" class="w-full px-4 py-2 border rounded focus:outline-none focus:border-primary" value=" <?php if(isset($cos['image'])) echo $cos['image']?>">
                </div>
                <button name="EDITart" type="submit" class="bg-primary text-white px-6 py-2 rounded hover:bg-opacity-90">
                    <i class="fas fa-paper-plane mr-1"></i>Edit
                </button>
            </form>
        </div>
        <!-- Articles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Sample Article Card -->
             <?php foreach($articles as $art){ ?>
            <article class="bg-white rounded-lg shadow-md overflow-hidden fade-in active h-auto ">
                <img src="<?php echo $art['image']?>" alt="Article image" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <span class="text-primary text-sm font-semibold">
                            <i class="fas fa-tag mr-1"></i><?php echo $art['catname']?>
                        </span>
                        <?php if (isset($_SESSION['user']) && $_SESSION['user']['useId'] === $art['userId']) { ?>
                        <div class="flex space-x-2">
                        <a href="blog.php?idArtedt=<?php echo $art['art_Id']?>"> <button id="editId" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-edit"></i></button></a>
                            </button>
                            <a href="blog.php?idArt=<?php echo $art['art_Id']?>"><button class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash"></i>
                            </button></a>
                        </div>
                        <?php }?>
                    </div>

                    <div class="flex items-center mb-3 text-neutral text-sm">
                        <i class="fas fa-clock mr-2"></i>
                        <span><?php echo $art['created_at']?></span>
                        <i class="fas fa-user mx-2"></i>
                        <span><?php echo $art['name']?></span>
                    </div>

                    <h3 class="text-secondary text-xl font-bold mt-2"><?php echo $art['title']?></h3>
                    <p class="text-neutral mt-2"><?php echo $art['content']?></p>
                    
                    <!-- Comments Section -->
                    <div class="mt-4 border-t pt-4">
                        <div class="comments-container">
                            <!-- Existing Comments -->
                            <div class="existing-comments space-y-4">
                                <!-- Sample Comment -->
                                <div class="bg-gray-50 p-3 rounded new-comment">
                                    <div class="flex items-center mb-2">
                                        <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white text-sm">JD</div>
                                        <div class="ml-3">
                                            <p class="text-secondary font-semibold">John Doe</p>
                                            <p class="text-neutral text-sm">
                                                <i class="fas fa-clock mr-1"></i>2 hours ago
                                            </p>
                                        </div>
                                    </div>
                                    <p class="text-secondary">Great article! Thanks for sharing.</p>
                                </div>
                            </div>
                            
                            <!-- Comment Form -->
                            <div class="comment-form comment-slide mt-4">
                                <form class="space-y-4">
                                    <input type="text" placeholder="Your name" class="w-full px-4 py-2 border rounded focus:outline-none focus:border-primary">
                                    <textarea placeholder="Write your comment..." class="w-full px-4 py-2 border rounded focus:outline-none focus:border-primary" rows="3"></textarea>
                                    <button type="submit" class="bg-primary text-white px-4 py-2 rounded hover:bg-opacity-90">
                                        <i class="fas fa-paper-plane mr-1"></i>Post Comment
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <button class="text-neutral hover:text-primary">
                                <i class="far fa-heart"></i>
                                <span class="ml-1">42</span>
                            </button>
                            <button class="text-neutral hover:text-primary comment-toggle">
                                <i class="far fa-comment"></i>
                                <span class="ml-1">12</span>
                            </button>
                        </div>
                        <span class="text-neutral text-sm">
                            <i class="fas fa-clock mr-1"></i>2 hours ago
                        </span>
                    </div>
                </div>
            </article>

             <?php }?>
           
        </div>
    </div>

    <script>
        // Toggle Article Form
        const addArticleBtn = document.getElementById('addArticleBtn');
        const articleForm = document.getElementById('articleForm');

        addArticleBtn.addEventListener('click', () => {
            articleForm.classList.toggle('active');
        });
        

        // Category Filter
        const categoryButtons = document.querySelectorAll('.category-filter');
        categoryButtons.forEach(button => {
            button.addEventListener('click', () => {
                categoryButtons.forEach(btn => btn.classList.remove('bg-primary'));
                categoryButtons.forEach(btn => btn.classList.add('bg-neutral'));
                button.classList.remove('bg-neutral');
                button.classList.add('bg-primary');
            });
        });

        // Comment Toggle
        document.querySelectorAll('.comment-toggle').forEach(button => {
            button.addEventListener('click', () => {
                const article = button.closest('article');
                const commentForm = article.querySelector('.comment-form');
                commentForm.classList.toggle('active');
            });
        });

        // Add New Comment
        document.querySelectorAll('.comment-form form').forEach(form => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const article = form.closest('article');
                const commentsContainer = article.querySelector('.existing-comments');
                const nameInput = form.querySelector('input');
                const commentInput = form.querySelector('textarea');

                const newComment = document.createElement('div');
                newComment.className = 'bg-gray-50 p-3 rounded new-comment';
                newComment.innerHTML = `
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white text-sm">
                            ${nameInput.value.substring(0, 2).toUpperCase()}
                        </div>
                        <div class="ml-3">
                            <p class="text-secondary font-semibold">${nameInput.value}</p>
                            <p class="text-neutral text-sm">
                                <i class="fas fa-clock mr-1"></i>Just now
                            </p>
                        </div>
                    </div>
                    <p class="text-secondary">${commentInput.value}</p>
                `;

                commentsContainer.insertBefore(newComment, commentsContainer.firstChild);
                form.reset();
            });
        });

        
        // Like Button Animation
        document.querySelectorAll('.fa-heart').forEach(heart => {
            heart.addEventListener('click', () => {
                heart.classList.toggle('fas');
                heart.classList.toggle('far');
                heart.closest('button').classList.toggle('text-primary');
            });
        });
    </script>
</body>
</html>