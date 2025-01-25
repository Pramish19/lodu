// Track tables that have placed orders
let tablesWithOrders = new Set(); // Added this to keep track of tables with orders

const menuContainer = document.getElementById("menu");
const orderItems = document.getElementById("order-items");
const totalElement = document.getElementById("total");
const tablesContainer = document.getElementById("tables-container");
const reorderButton = document.createElement("button"); // Reorder button

let order = [];
let total = 0;
let selectedTable = null;

// Initialize Reorder Button
reorderButton.innerText = "Re-order";
reorderButton.style.display = "none"; // Initially hidden
reorderButton.addEventListener("click", () => {
  if (!selectedTable) {
    alert("Please select a table first.");
    return;
  }
  alert(`You can now reorder for Table ${selectedTable}.`);
  order = []; // Reset the order for the new session
  updateOrder(); // Update UI
});
document.getElementById("order-summary").appendChild(reorderButton); // Add the reorder button to the page

// Fetch and display menu items
fetch("php/menu.php")
  .then((response) => response.json())
  .then((data) => {
    const groupedDishes = data.reduce((acc, dish) => {
      if (!acc[dish.category]) {
        acc[dish.category] = [];
      }
      acc[dish.category].push(dish);
      return acc;
    }, {});

    Object.keys(groupedDishes).forEach((category) => {
      const categoryDiv = document.createElement("div");
      categoryDiv.classList.add("category-section");
      categoryDiv.innerHTML = `<h2>${category}</h2>`;

      groupedDishes[category].forEach((dish) => {
        const dishDiv = document.createElement("div");
        dishDiv.innerHTML = `
              <div class="order-card">
                  <div class="order-description">
                      <h3>${dish.name} (Rs${dish.price})</h3>
                      <p>${dish.description}</p>
                  </div>
                  <button onclick="addToOrder(${dish.id}, '${dish.name}', ${dish.price})">Add to Order</button>
              </div>
          `;
        categoryDiv.appendChild(dishDiv);
      });

      menuContainer.appendChild(categoryDiv);
    });
  })
  .catch((err) => console.error("Error loading menu:", err));

function addToOrder(id, name, price) {
  const existing = order.find((item) => item.id === id);
  if (existing) {
    existing.quantity++;
  } else {
    order.push({ id, name, price, quantity: 1 });
  }
  updateOrder();
}

function subtractFromOrder(id) {
  const existing = order.find((item) => item.id === id);
  if (existing) {
    existing.quantity--;
    if (existing.quantity === 0) {
      order = order.filter((item) => item.id !== id);
    }
    updateOrder();
  }
}

function updateOrder() {
  orderItems.innerHTML = "";
  total = 0;

  order.forEach((item) => {
    total += item.price * item.quantity;

    const li = document.createElement("li");
    li.className = "order-item";
    li.innerHTML = `
            <span class="item-name">${item.name}</span>
            <span class="item-quantity">x${item.quantity}</span>
            <span class="item-price">Rs${(item.price * item.quantity).toFixed(
              2
            )}</span>
            <button class="subtract-btn" onclick="subtractFromOrder(${
              item.id
            })">-</button>
        `;
    orderItems.appendChild(li);
  });

  totalElement.innerText = `Rs${total.toFixed(2)}`;
}

function loadTables() {
  fetch("php/fetchTables.php")
    .then((response) => response.json())
    .then((tables) => {
      tablesContainer.innerHTML = "";

      if (tables.length === 0) {
        tablesContainer.innerHTML = "<p>No tables found.</p>";
        return;
      }

      const availableTables = tables.filter(
        (table) => table.status === "available"
      );
      const occupiedTables = tables.filter(
        (table) => table.status === "occupied"
      );

      const availableSection = document.createElement("div");
      availableSection.innerHTML = "<h3>Available Tables</h3>";
      availableTables.forEach((table) => {
        const tableDiv = document.createElement("div");
        tableDiv.classList.add("table", "available");
        tableDiv.innerHTML = `
            <p>Table ${table.table_number}</p>
            <button onclick="selectTable(${table.table_number})">Select Table</button>
          `;
        availableSection.appendChild(tableDiv);
      });

      const occupiedSection = document.createElement("div");
      occupiedSection.innerHTML = "<h3>Occupied Tables</h3>";
      occupiedTables.forEach((table) => {
        const tableDiv = document.createElement("div");
        tableDiv.classList.add("table", "occupied");
        tableDiv.innerHTML = `
            <p>Table ${table.table_number} (Occupied)</p>
            <button disabled>Unavailable</button>
          `;
        occupiedSection.appendChild(tableDiv);
      });

      tablesContainer.appendChild(availableSection);
      tablesContainer.appendChild(occupiedSection);
    })
    .catch((err) => console.error("Error loading tables:", err));
}

function selectTable(tableNumber) {
  if (selectedTable === tableNumber) {
    alert(`You are already using Table ${tableNumber}.`);
    return;
  }

  if (selectedTable !== null) {
    alert(
      "You can select only one table. Please deselect your current table first."
    );
    return;
  }

  fetch("php/updateTable.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ table: tableNumber }),
  })
    .then((response) => response.json())
    .then((data) => {
      
      console.log(data);

      if (data.success) {
        selectedTable = tableNumber;
        alert(`Table ${tableNumber} selected successfully!`);
        loadTables();
      } else {
        alert("Failed to update table information.");
      }
    })
    .catch((err) => console.error("Error:", err));
}

// function placeOrder() {
//   if (!selectedTable) {
//     alert("Please select a table first.");
//     return;
//   }

//   const orderData = {
//     table: selectedTable,
//     order: order.map((item) => ({
//       id: item.id,
//       quantity: item.quantity,
//       name: item.name,
//     })),
//     total: total,
//   };

//   fetch("php/order.php", {
//     method: "POST",
//     headers: { "Content-Type": "application/json" },
//     body: JSON.stringify(orderData),
//   })
//     .then((response) => {
//       if (!response.ok) throw new Error("Failed to place order");
//       return response.json();
//     })
//     .then((data) => {
//       console.log(data);
//       if (data.success) {
//         alert("Order placed successfully!");

//         tablesWithOrders.add(selectedTable); // Mark table as having placed an order

//         console.log(tablesWithOrders);
       
//         console.log(reorderButton.style.display); // Log the display state of the reorder button

//         reorderButton.style.display = "inline-block"; // Show the reorder button
//         setTimeout(() => {
//           reorderButton.style.display = "inline-block"; // Try again after a short delay
//         }, 100);
//         order = [];
//         total = 0;
//         updateOrder();
//         loadTables();
//       } else {
//         alert(data.message);
//       }
//     })
//     .catch((err) => console.error("Error placing order:", err));
// }

function placeOrder() {
  if (!selectedTable) {
    alert("Please select a table first.");
    return;
  }

  const orderData = {
    table: selectedTable,
    order: order.map((item) => ({
      id: item.id,
      quantity: item.quantity,
      name: item.name,
    })),
    total: total,
  };

  fetch("php/order.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(orderData),
  })
    .then((response) => {
      if (!response.ok) throw new Error("Failed to place order");
      return response.json();
    })
    .then((data) => {
      console.log(data); 

      if (data.success) {
        alert("Order placed successfully!");

        tablesWithOrders.add(selectedTable); 

         reorderButton.style.display = "inline-block"; 
        setTimeout(() => {
          reorderButton.style.display = "inline-block"; 
        }, 100);

        order = [];
        total = 0;
        updateOrder();
        loadTables();
      } else {
        alert(data.message);
      }
    })
    .catch((err) => console.error("Error placing order:", err));
}


function clearOrder() {
  if (confirm("Are you sure want to reset the order")) {
    order = [];
    total = 0;
    orderItems.innerHTML = "";
    totalElement.innerText = total.toFixed(2);
    alert("Order has been reset!");
  }
}

document.addEventListener("DOMContentLoaded", () => {
  loadTables();
});