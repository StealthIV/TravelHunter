 // Define variables
 const span = document.getElementsByClassName('span1');
 const span1 = document.getElementsByClassName('span2');
 const span2 = document.getElementsByClassName('span3');
 const span3 = document.getElementsByClassName('span4');
 const products = document.getElementsByClassName('product');
 let l = 0; // position of the left move
 let movePer = 25.34; // how much to move per click
 let maxMove = 203; // maximum move percentage

 // Mobile view - media query
 let mob_view = window.matchMedia("(max-width: 768px)");
 if (mob_view.matches) {
	 movePer = 50.36;
	 maxMove = 504;
 }

 // Right mover function (to move the products right)
 let right_mover = () => {
	 l = l + movePer;
	 if (l > maxMove) {
		 l = maxMove;  // Prevent going beyond the max move
	 }
	 for (const i of products) {
		 i.style.left = '-' + l + '%';  // Move all products
	 }
 };

 // Left mover function (to move the products left)
 let left_mover = () => {
	 l = l - movePer;
	 if (l <= 0) {
		 l = 0;  // Prevent going before 0
	 }
	 for (const i of products) {
		 i.style.left = '-' + l + '%';  // Move all products
	 }
 };

 // Click event for left and right arrows
 span[1].onclick = () => { right_mover(); };  // Span 1 right arrow
 span[0].onclick = () => { left_mover(); };   // Span 1 left arrow

 span1[1].onclick = () => { right_mover(); };  // Span 2 right arrow
 span1[0].onclick = () => { left_mover(); };   // Span 2 left arrow

 span2[1].onclick = () => { right_mover(); };  // Span 3 right arrow
 span2[0].onclick = () => { left_mover(); };   // Span 3 left arrow

 span3[1].onclick = () => { right_mover(); };  // Span 4 right arrow
 span3[0].onclick = () => { left_mover(); };   // Span 4 left arrow

 // Optional: Resize handler for mobile view
 mob_view.addEventListener('change', (e) => {
	 if (e.matches) {
		 movePer = 50.36;
		 maxMove = 504;
	 } else {
		 movePer = 25.34;
		 maxMove = 203;
	 }
 });