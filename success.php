<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Success Page
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
  <style>
   @keyframes successAnimation {
            0% { transform: scale(0.5); opacity: 0; }
            50% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(1); }
        }
        .animate-success {
            animation: successAnimation 0.5s ease-in-out;
        }
  </style>
 </head>
 <body class="bg-gray-100 font-roboto flex items-center justify-center min-h-screen">
  <div class="bg-white p-8 rounded-lg shadow-lg text-center animate-success">
   <div class="flex justify-center mb-4">
    <img alt="A green checkmark indicating success" class="w-24 h-24" height="100" src="https://storage.googleapis.com/a1aa/image/0JbfWDbjNs09ZSstM8SmIHWSdiuAEOOIdbNhBhTgEf4k6MAUA.jpg" width="100"/>
   </div>
   <h1 class="text-3xl font-bold text-green-600 mb-2">
    Success!
   </h1>
   <p class="text-gray-700 mb-6">
    Your content has been successfully published.
   </p>
   <div class="flex justify-center space-x-4">
    <button class="bg-green-500 text-white px-6 py-2 rounded-full hover:bg-green-600 transition duration-300" onclick="window.location.href='blog.php'">
     <i class="fas fa-external-link-alt mr-2">
     </i>
     Visit
    </button>
    <button class="bg-gray-500 text-white px-6 py-2 rounded-full hover:bg-gray-600 transition duration-300" onclick="window.location.href='dashboard.php'">
     <i class="fas fa-times mr-2">
     </i>
     Close
    </button>
   </div>
  </div>
 </body>
</html>