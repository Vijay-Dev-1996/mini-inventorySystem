
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Store Billing - New Order</title>

    <style>
        :root {
            --navy: #1e293b;
            --ink: #1f2a37;
            --muted: #687586;
            --line: #dce3e8;
            --surface: #ffffff;
            --canvas: #f3f6f6;
            --green: #16805d;
            --green-hover: #11694c;
            --danger: #c0392b;
            --warning: #b7791f;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding-top: 40px;
            background: var(--canvas);
            color: var(--ink);
            font-family: "Segoe UI", Arial, sans-serif;
            font-size: 14px;
            line-height: 1.45;
        }

        .topbar {
            position: fixed;
            z-index: 5;
            inset: 0 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            width: 100%;
            height: 40px;
            padding: 0 24px;
            background: var(--navy);
            color: #fff;
        }

        .brand {
            font-size: 13px;
            font-weight: 650;
        }

        .wireframe-label {
            color: #cbd5e1;
            font-size: 10px;
            font-weight: 700;
        }

        main {
            width: min(1160px, calc(100% - 48px));
            margin: 28px auto 48px;
        }

        h1,
        h2,
        p {
            margin: 0;
        }

        h1,
        h2 {
            font-size: 15px;
            font-weight: 650;
        }

        .section-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 26px;
            margin: 0 0 11px;
        }

        .surface {
            border: 1px solid var(--line);
            border-radius: 5px;
            background: var(--surface);
        }

        .customer-section {
            width: 70%;
        }

        .customer-fields {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 17px;
            padding: 16px;
        }

        .field {
            display: grid;
            gap: 6px;
        }

        label {
            color: #465365;
            font-size: 12px;
            font-weight: 600;
        }

        input,
        select {
            width: 100%;
            min-width: 0;
            height: 38px;
            padding: 0 10px;
            border: 1px solid #cbd5dc;
            border-radius: 4px;
            background: #fff;
            color: var(--ink);
            font: inherit;
        }

        input:focus,
        select:focus {
            outline: 2px solid #16805d33;
            border-color: var(--green);
        }

        .products-layout {
            display: grid;
            grid-template-columns: minmax(0, 1.8fr) minmax(230px, 1fr);
            align-items: start;
            gap: 20px;
            margin-top: 25px;
        }

        .table-shell {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            height: 40px;
            padding: 0 13px;
            border-bottom: 1px solid var(--line);
            background: #f8fafb;
            color: #566475;
            font-size: 11px;
            font-weight: 700;
        }

        th:not(:first-child) {
            text-align: right;
        }

        th:first-child {
            width: 40%;
        }

        th:nth-child(2) {
            width: 12%;
        }

        th:nth-child(3) {
            width: 15%;
        }

        th:nth-child(4) {
            width: 18%;
        }

        th:last-child {
            width: 15%;
        }

        td {
            padding: 8px 10px;
            border-bottom: 1px solid #edf0f2;
        }

        td:not(:first-child) {
            text-align: right;
        }

        .product-entry select,
        .product-entry input {
            height: 32px;
            padding: 0 7px;
        }

        .product-entry input {
            text-align: right;
        }

        .remove-button {
            min-height: 30px;
            padding: 0 9px;
            background: #fff;
            border: 1px solid #d9a5a0;
            color: var(--danger);
            font-size: 11px;
        }

        .remove-button:hover {
            background: #fff5f4;
        }

        .product-actions {
            display: flex;
            justify-content: flex-end;
            padding: 10px 0 0;
        }

        button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 37px;
            padding: 0 13px;
            border: 1px solid transparent;
            border-radius: 4px;
            font: inherit;
            font-size: 12px;
            font-weight: 650;
            cursor: pointer;
        }

        button:disabled {
            opacity: .6;
            cursor: not-allowed;
        }

        .add-button {
            border-color: #2E74B5;
            background: #2E74B5;
            color: #fff;
        }

        .add-button:hover {
            filter: brightness(.94);
        }

        .stock-box {
            min-height: 170px;
        }

        .stock-box .section-heading {
            min-height: 48px;
            padding: 0 14px;
            border-bottom: 1px solid var(--line);
        }

        .stock-list {
            padding: 10px 14px;
        }

        .stock-item {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            padding: 9px 0;
            border-bottom: 1px solid #edf0f2;
        }

        .stock-item:last-child {
            border-bottom: 0;
        }

        .stock-name {
            font-weight: 600;
        }

        .stock-count {
            color: var(--danger);
            font-weight: 700;
        }

        .empty-message {
            padding: 14px;
            color: var(--muted);
            font-size: 12px;
        }

        .payment-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            align-items: start;
            gap: 20px;
            margin-top: 25px;
        }

        .payment-box {
            width: min(100%, 590px);
        }

        .payment-box .section-heading {
            min-height: 48px;
            padding: 0 14px;
            border-bottom: 1px solid var(--line);
        }

        .payment-content {
            padding: 4px 14px 14px;
        }

        .payment-line {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(100px, 180px);
            align-items: center;
            gap: 14px;
            min-height: 40px;
            border-bottom: 1px solid #edf0f2;
            color: #4c5969;
        }

        .payment-line:last-child {
            border-bottom: 0;
        }

        .payment-line input {
            height: 32px;
        }

        .payment-line.total {
            color: var(--ink);
            font-weight: 700;
        }

        .amount {
            text-align: right;
            font-weight: 600;
        }

        .generate-area {
            display: flex;
            justify-content: flex-end;
            padding-top: 1px;
        }

        .generate-button {
            min-width: 145px;
            min-height: 42px;
            background: var(--green);
            color: #fff;
        }

        .generate-button:hover {
            background: var(--green-hover);
        }

        .generate-button:disabled {
            opacity: .7;
            cursor: not-allowed;
        }

        /* Loading spinner */
        .loader {
            display: none;
            width: 16px;
            height: 16px;
            margin-left: 8px;
            border: 2px solid #fff;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin .8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .message {
            display: none;
            margin-top: 18px;
            padding: 12px 14px;
            border-radius: 4px;
            font-size: 13px;
        }

        .message.success {
            display: block;
            background: #eaf7f1;
            border: 1px solid #b7dfcc;
            color: #126341;
        }

        .message.error {
            display: block;
            background: #fff1f0;
            border: 1px solid #e5b8b3;
            color: #a52d22;
        }


        /* ORDER HISTORY DRAWER */
        .history-button {
            min-height: 30px;
            padding: 0 12px;
            border: 1px solid #94a3b8;
            border-radius: 4px;
            background: transparent;
            color: #fff;
            font-size: 12px;
            font-weight: 650;
        }

        .history-button:hover {
            background: #334155;
        }

        .history-overlay {
            position: fixed;
            inset: 0;
            z-index: 20;
            display: none;
            background: rgba(15, 23, 42, .35);
        }

        .history-overlay.open {
            display: block;
        }

        .history-drawer {
            position: fixed;
            top: 0;
            right: -620px;
            z-index: 21;
            width: min(620px, 100%);
            height: 100vh;
            padding: 20px;
            overflow-y: auto;
            background: #fff;
            box-shadow: -6px 0 20px rgba(15, 23, 42, .18);
            transition: right .25s ease;
        }

        .history-drawer.open {
            right: 0;
        }

        .history-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 18px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--line);
        }

        .history-header h2 {
            font-size: 17px;
        }

        .history-close {
            min-height: 32px;
            padding: 0 10px;
            border: 1px solid #cbd5dc;
            background: #fff;
            color: var(--danger);
        }

        .history-search {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 10px;
            margin-bottom: 16px;
        }

        .history-search input {
            height: 38px;
        }

        .history-search button {
            min-height: 38px;
            background: var(--green);
            color: #fff;
        }

        .history-search button:hover {
            background: var(--green-hover);
        }

        .history-message {
            display: none;
            margin-bottom: 14px;
            padding: 10px 12px;
            border-radius: 4px;
            font-size: 12px;
        }

        .history-message.show {
            display: block;
        }

        .history-message.error {
            background: #fff1f0;
            border: 1px solid #e5b8b3;
            color: #a52d22;
        }

        .history-message.success {
            background: #eaf7f1;
            border: 1px solid #b7dfcc;
            color: #126341;
        }

        .history-customer {
            margin-bottom: 14px;
            padding: 12px 14px;
            border: 1px solid var(--line);
            border-radius: 5px;
            background: #f8fafb;
        }

        .history-customer strong {
            display: block;
            margin-bottom: 3px;
        }

        .history-table-shell {
            overflow-x: auto;
            border: 1px solid var(--line);
            border-radius: 5px;
        }

        .history-table {
            min-width: 520px;
        }

        .history-table th {
            text-align: left !important;
        }

        .history-table td {
            vertical-align: top;
            text-align: left !important;
        }

        .history-products {
            margin: 0;
            padding-left: 17px;
        }

        .history-products li {
            margin-bottom: 3px;
        }

        .history-total {
            white-space: nowrap;
            font-weight: 700;
        }


        .history-table th:last-child,
        .history-table td:last-child {
            text-align: center !important;
            white-space: nowrap;
        }

        .view-bill-button {
            min-height: 32px;
            padding: 0 11px;
            border: 1px solid #cbd5dc;
            border-radius: 4px;
            background: #fff;
            color: var(--green);
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
        }

        .view-bill-button:hover {
            background: #f0f8f5;
        }

        .bill-modal {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 30;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(15, 23, 42, .45);
        }

        .bill-modal.open {
            display: flex;
        }

        .bill-card {
            width: min(560px, 100%);
            max-height: 90vh;
            overflow-y: auto;
            padding: 20px;
            border: 1px solid var(--line);
            border-radius: 6px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .2);
        }

        .bill-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--line);
        }

        .bill-header h3 {
            margin: 0;
            font-size: 17px;
        }

        .bill-close {
            min-height: 32px;
            padding: 0 11px;
            border: 1px solid #cbd5dc;
            border-radius: 4px;
            background: #fff;
            color: var(--danger);
            cursor: pointer;
        }

        .bill-customer {
            margin-bottom: 16px;
            padding: 11px 13px;
            border: 1px solid var(--line);
            border-radius: 5px;
            background: #f8fafb;
        }

        .bill-customer strong {
            display: block;
            margin-bottom: 3px;
        }

        .bill-items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }

        .bill-items th,
        .bill-items td {
            padding: 9px 8px;
            border-bottom: 1px solid var(--line);
            text-align: left;
        }

        .bill-items th:last-child,
        .bill-items td:last-child {
            text-align: right;
        }

        .bill-summary {
            margin-left: auto;
            width: min(260px, 100%);
        }

        .bill-summary-row {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            padding: 6px 0;
        }

        .bill-summary-row.total {
            margin-top: 4px;
            padding-top: 10px;
            border-top: 1px solid var(--line);
            font-weight: 700;
            font-size: 15px;
        }

        @media (max-width: 480px) {
            .history-drawer {
                padding: 14px;
            }

            .history-search {
                grid-template-columns: 1fr;
            }

            .history-search button {
                width: 100%;
            }
        }

        @media (max-width: 720px) {
            main {
                width: min(100% - 28px, 620px);
                margin-top: 20px;
            }

            .customer-section {
                width: 100%;
            }

            .products-layout {
                grid-template-columns: 1fr;
                gap: 14px;
                margin-top: 21px;
            }

            .payment-layout {
                grid-template-columns: 1fr;
                gap: 14px;
                margin-top: 21px;
            }

            .payment-box {
                width: 100%;
            }

            .generate-area {
                justify-content: stretch;
            }

            .generate-button {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .topbar {
                padding: 0 12px;
            }

            .brand {
                font-size: 12px;
            }

            .wireframe-label {
                font-size: 9px;
            }

            main {
                width: calc(100% - 24px);
            }

            .customer-fields {
                grid-template-columns: 1fr;
                gap: 12px;
                padding: 13px;
            }

            th {
                padding: 0 8px;
            }
        }
    </style>
</head>

<body>

<header class="topbar">
    <div class="brand">Store Billing — New Order</div>
    <button type="button" class="history-button" id="history-button">
        Order History
    </button>
</header>

<main>

    <!-- CUSTOMER -->
    <section class="customer-section">

        <div class="section-heading">
            <h1>Customer</h1>
        </div>

        <div class="surface customer-fields">

            <div class="field">
                <label for="customer-email">Email</label>

                <input
                    id="customer-email"
                    name="customer_email"
                    type="email"
                    placeholder="e.g. vijay@gmail.com"
                    autocomplete="email"
                >
            </div>

            <div class="field">
                <label for="customer-name">Name</label>

                <input
                    id="customer-name"
                    name="customer_name"
                    type="text"
                    placeholder="Customer name"
                    autocomplete="name"
                >
            </div>

        </div>

    </section>


    <!-- PRODUCTS -->
    <div class="products-layout">

        <section>

            <div class="section-heading">
                <h2>Products</h2>
            </div>

            <div class="surface">

                <div class="table-shell">

                    <table>

                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Line Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody id="product-rows"></tbody>

                    </table>

                </div>

            </div>

            <div class="product-actions">

                <button
                    class="add-button"
                    type="button"
                    id="add-product-button"
                >
                    + Add Product
                </button>

            </div>

        </section>


        <!-- LOW STOCK -->
        <aside>

            <div class="section-heading">
                <h2>Low Stock Alert</h2>
            </div>

            <div class="surface stock-box">

                <div
                    id="low-stock-list"
                    class="stock-list"
                >
                    <div class="empty-message">
                        Loading...
                    </div>
                </div>

            </div>

        </aside>

    </div>


    <!-- PAYMENT -->
    <div class="payment-layout">

        <section class="surface payment-box">

            <div class="section-heading">
                <h2>Payment</h2>
            </div>

            <div class="payment-content">

                <div class="payment-line">
                    <span>Subtotal</span>

                    <span
                        id="subtotal"
                        class="amount"
                    >
                        ₹0.00
                    </span>
                </div>

                <div class="payment-line">
                    <span>Tax</span>

                    <span
                        id="tax"
                        class="amount"
                    >
                        ₹0.00
                    </span>
                </div>

                <div class="payment-line total">
                    <span>Grand Total</span>

                    <span
                        id="grand-total"
                        class="amount"
                    >
                        ₹0.00
                    </span>
                </div>

                <div class="payment-line">

                    <label for="amount-given">
                        Amount Given by Customer
                    </label>

                    <input
                        id="amount-given"
                        name="amount_given"
                        type="number"
                        step="0.01"
                        min="0"
                        inputmode="decimal"
                        placeholder="0.00"
                    >

                </div>

                <div class="payment-line total">

                    <span>Balance to Return</span>

                    <span
                        id="balance"
                        class="amount"
                    >
                        ₹0.00
                    </span>

                </div>

            </div>

        </section>


        <div class="generate-area">

            <button
                class="generate-button"
                type="button"
                id="generate-bill-button"
            >
                <span id="buttonText">Generate Bill</span>
                <span
                    id="buttonLoader"
                    class="loader"
                ></span>
            </button>

        </div>

    </div>


    <!-- MESSAGE -->
    <div
        id="message"
        class="message"
    ></div>

</main>


<!-- ORDER HISTORY DRAWER -->
<div id="history-overlay" class="history-overlay"></div>

<aside id="history-drawer" class="history-drawer" aria-label="Order History">
    <div class="history-header">
        <h2>Order History</h2>

        <button type="button" class="history-close" id="history-close-button">
            Close
        </button>
    </div>

    <div class="history-search">
        <input
            id="history-email"
            type="email"
            placeholder="Enter customer email"
            autocomplete="email"
        >

        <button type="button" id="history-search-button">
            Search
        </button>
    </div>

    <div id="history-message" class="history-message"></div>

    <div id="history-result"></div>
</aside>

<!-- BILL VIEW MODAL -->
<div id="bill-modal" class="bill-modal" aria-hidden="true">
    <div class="bill-card" role="dialog" aria-modal="true" aria-label="Bill Details">
        <div class="bill-header">
            <h3>Bill Details</h3>
            <button type="button" class="bill-close" id="bill-close-button">
                Close
            </button>
        </div>
        <div id="bill-content"></div>
    </div>
</div>

<script>

    /*
     * Laravel API
     */
    const API_BASE = 'http://localhost:8000/api';

    let products = [];


    /*
     * Format money
     */
    function formatMoney(value) {
        return '₹' + Number(value || 0).toFixed(2);
    }


    /*
     * Show message
     */
    function showMessage(message, type = 'success') {

        const element =
            document.getElementById('message');

        element.textContent = message;

        element.className =
            'message ' + type;
    }


    /*
     * Load products
     */
    async function loadProducts() {

        try {

            const response =
                await fetch(`${API_BASE}/products`);

            if (!response.ok) {
                throw new Error('Unable to load products');
            }

            products = await response.json();

            /*
             * Add first empty row
             */
            addProductRow();

        } catch (error) {

            console.error(error);

            showMessage(
                'Unable to load products from the server.',
                'error'
            );
        }
    }


    /*
     * Load low stock products
     */
    async function loadLowStockProducts() {

        const container =
            document.getElementById('low-stock-list');

        try {

            const response =
                await fetch(
                    `${API_BASE}/products/low-stock`
                );

            if (!response.ok) {
                throw new Error(
                    'Unable to load low-stock products'
                );
            }

            const lowStockProducts =
                await response.json();

            if (lowStockProducts.length === 0) {

                container.innerHTML = `
                    <div class="empty-message">
                        No low-stock products.
                    </div>
                `;

                return;
            }

            container.innerHTML =
                lowStockProducts
                    .map(product => {

                        return `
                            <div class="stock-item">

                                <span class="stock-name">
                                    ${escapeHtml(product.name)}
                                </span>

                                <span class="stock-count">
                                    ${product.stock}
                                </span>

                            </div>
                        `;

                    })
                    .join('');

        } catch (error) {

            console.error(error);

            container.innerHTML = `
                <div class="empty-message">
                    Unable to load stock information.
                </div>
            `;
        }
    }


    /*
     * Add product row
     */
    function addProductRow() {

        const tbody =
            document.getElementById('product-rows');

        const row =
            document.createElement('tr');

        row.className =
            'product-entry';

        row.innerHTML = `

            <td>

                <select
                    class="product-select"
                    aria-label="Select a product"
                >

                    <option value="">
                        Select a product
                    </option>

                    ${products.map(product => `

                        <option value="${product.id}">
                            ${escapeHtml(product.name)}
                            - ${escapeHtml(product.code)}
                        </option>

                    `).join('')}

                </select>

            </td>


            <td>

                <input
                    type="number"
                    class="quantity-input"
                    min="1"
                    step="1"
                    value="1"
                    aria-label="Quantity"
                >

            </td>


            <td>

                <span class="price">
                    ₹0.00
                </span>

            </td>


            <td>

                <span class="line-total">
                    ₹0.00
                </span>

            </td>


            <td>

                <button
                    type="button"
                    class="remove-button"
                >
                    Remove
                </button>

            </td>

        `;

        tbody.appendChild(row);


        const select =
            row.querySelector('.product-select');

        const quantityInput =
            row.querySelector('.quantity-input');


        select.addEventListener(
            'change',
            () => updateRow(row)
        );


        quantityInput.addEventListener(
            'input',
            () => updateRow(row)
        );


        row.querySelector('.remove-button')
            .addEventListener(
                'click',
                () => {

                    row.remove();

                    calculateTotals();
                }
            );
    }


    /*
     * Update product row
     */
    function updateRow(row) {

        const productId =
            Number(
                row.querySelector('.product-select').value
            );

        const quantity =
            Number(
                row.querySelector('.quantity-input').value
            );

        const product =
            products.find(
                item => item.id === productId
            );

        const priceElement =
            row.querySelector('.price');

        const lineTotalElement =
            row.querySelector('.line-total');


        if (!product) {

            priceElement.textContent =
                formatMoney(0);

            lineTotalElement.textContent =
                formatMoney(0);

            calculateTotals();

            return;
        }


        /*
         * Show price
         */
        priceElement.textContent =
            formatMoney(product.price);


        /*
         * Check stock
         */
        if (quantity > product.stock) {

            row.querySelector('.quantity-input')
                .setCustomValidity(
                    `Only ${product.stock} item(s) available.`
                );

        } else {

            row.querySelector('.quantity-input')
                .setCustomValidity('');

        }


        /*
         * Calculate line total
         */
        const lineSubtotal =
            Number(product.price) * quantity;

        const lineTax =
            lineSubtotal *
            (Number(product.tax_percentage) / 100);

        const lineTotal =
            lineSubtotal + lineTax;


        lineTotalElement.textContent =
            formatMoney(lineTotal);


        calculateTotals();
    }


    /*
     * Calculate order totals
     */
    function calculateTotals() {

        let subtotal = 0;
        let tax = 0;


        document
            .querySelectorAll('#product-rows tr')
            .forEach(row => {

                const productId =
                    Number(
                        row.querySelector('.product-select').value
                    );

                const quantity =
                    Number(
                        row.querySelector('.quantity-input').value
                    );

                const product =
                    products.find(
                        item => item.id === productId
                    );


                if (!product || quantity <= 0) {
                    return;
                }


                const lineSubtotal =
                    Number(product.price) * quantity;

                const lineTax =
                    lineSubtotal *
                    (Number(product.tax_percentage) / 100);


                subtotal += lineSubtotal;
                tax += lineTax;

            });


        const grandTotal =
            subtotal + tax;


        document.getElementById('subtotal')
            .textContent =
            formatMoney(subtotal);


        document.getElementById('tax')
            .textContent =
            formatMoney(tax);


        document.getElementById('grand-total')
            .textContent =
            formatMoney(grandTotal);


        calculateBalance();
    }


    /*
     * Calculate balance
     */
    function calculateBalance() {

        const grandTotal =
            getNumberFromMoney(
                document
                    .getElementById('grand-total')
                    .textContent
            );


        const amountGiven =
            Number(
                document
                    .getElementById('amount-given')
                    .value
            ) || 0;


        const balance =
            amountGiven - grandTotal;


        document
            .getElementById('balance')
            .textContent =
            formatMoney(
                Math.max(balance, 0)
            );
    }


    /*
     * Convert money text to number
     */
    function getNumberFromMoney(value) {

        return Number(
            String(value)
                .replace('₹', '')
                .replace(/,/g, '')
        ) || 0;
    }


    /*
     * Find customer by email
     */
    async function findCustomer() {

        const email =
            document
                .getElementById('customer-email')
                .value
                .trim();


        if (!email) {
            return;
        }


        try {

            const response =
                await fetch(
                    `${API_BASE}/customers/by-email/${encodeURIComponent(email)}`
                );


            if (response.status === 404) {

                document
                    .getElementById('customer-name')
                    .value = '';

                return;
            }


            if (!response.ok) {
                throw new Error(
                    'Customer lookup failed'
                );
            }


            const customer =
                await response.json();


            document
                .getElementById('customer-name')
                .value =
                customer.name;


        } catch (error) {

            console.error(error);
        }
    }


    /*
     * Create order
     */
    async function createOrder() {

        const customerName =
            document
                .getElementById('customer-name')
                .value
                .trim();


        const customerEmail =
            document
                .getElementById('customer-email')
                .value
                .trim();


        if (!customerName) {

            showMessage(
                'Please enter customer name.',
                'error'
            );

            return;
        }


        if (!customerEmail) {

            showMessage(
                'Please enter customer email.',
                'error'
            );

            return;
        }


        /*
         * Collect selected products
         */
        const selectedProducts = [];


        document
            .querySelectorAll('#product-rows tr')
            .forEach(row => {

                const productId =
                    Number(
                        row
                            .querySelector('.product-select')
                            .value
                    );


                const quantity =
                    Number(
                        row
                            .querySelector('.quantity-input')
                            .value
                    );


                if (productId && quantity > 0) {

                    selectedProducts.push({
                        product_id: productId,
                        quantity: quantity
                    });

                }

            });


        if (selectedProducts.length === 0) {

            showMessage(
                'Please select at least one product.',
                'error'
            );

            return;
        }


        /*
         * Loading
         */
        const button =
            document.getElementById(
                'generate-bill-button'
            );


        const buttonText =
            document.getElementById(
                'buttonText'
            );


        const buttonLoader =
            document.getElementById(
                'buttonLoader'
            );


        button.disabled = true;

        buttonText.textContent =
            'Creating...';

        buttonLoader.style.display =
            'inline-block';


        try {

            const response =
                await fetch(
                    `${API_BASE}/orders`,
                    {
                        method: 'POST',

                        headers: {
                            'Content-Type':
                                'application/json',

                            'Accept':
                                'application/json'
                        },

                        body: JSON.stringify({

                            customer_name:
                                customerName,

                            customer_email:
                                customerEmail,

                            products:
                                selectedProducts

                        })
                    }
                );


            const result =
                await response.json();


            /*
             * Validation / stock error
             */
            if (!response.ok) {

                let message =
                    result.message ||
                    'Unable to create order.';


                if (result.errors) {

                    const errors =
                        Object
                            .values(result.errors)
                            .flat();


                    if (errors.length > 0) {

                        message =
                            errors.join(' ');
                    }
                }


                showMessage(
                    message,
                    'error'
                );

                return;
            }


            /*
             * Order created successfully
             */
            alert(
                // `Order #${result.data.customer.email} Email Send successfully.`,
				`Email Send successfully.`,
                'success'
            );

            setTimeout(() => {

                window.location.reload();

            }, 500);


        } catch (error) {

            console.error(error);


            showMessage(
                'Unable to connect to the Laravel server.',
                'error'
            );


        } finally {

            /*
             * Stop loading
             */
            button.disabled = false;

            buttonText.textContent =
                'Generate Bill';

            buttonLoader.style.display =
                'none';
        }

    }


    /*
     * Basic HTML escaping
     */
    function escapeHtml(value) {

        return String(value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }



    /*
     * Order History
     */
    function openHistory() {
        document
            .getElementById('history-drawer')
            .classList.add('open');

        document
            .getElementById('history-overlay')
            .classList.add('open');

        setTimeout(() => {
            document
                .getElementById('history-email')
                .focus();
        }, 100);
    }


    function closeHistory() {
         document.getElementById('history-drawer').classList.remove('open');
    document.getElementById('history-overlay').classList.remove('open');

    document.getElementById('history-email').value = '';
    document.getElementById('history-result').innerHTML = '';

    document.getElementById('history-message').textContent = '';
    document.getElementById('history-message').className = 'history-message';
    }


    function showHistoryMessage(message, type = 'success') {
        const element =
            document.getElementById('history-message');

        element.textContent = message;
        element.className =
            'history-message show ' + type;
    }


    function clearHistoryMessage() {
        const element =
            document.getElementById('history-message');

        element.textContent = '';
        element.className = 'history-message';
    }


    async function searchOrderHistory() {
        const email =
            document
                .getElementById('history-email')
                .value
                .trim();

        const resultContainer =
            document.getElementById('history-result');

        clearHistoryMessage();

        if (!email) {
            showHistoryMessage(
                'Please enter customer email.',
                'error'
            );
            resultContainer.innerHTML = '';
            return;
        }

        resultContainer.innerHTML = `
            <div class="empty-message">
                Loading order history...
            </div>
        `;

        try {
            const response =
                await fetch(
                    `${API_BASE}/customers/${encodeURIComponent(email)}/orders`,
                    {
                        headers: {
                            'Accept': 'application/json'
                        }
                    }
                );

            let result = null;

            try {
                result = await response.json();
            } catch (error) {
                result = null;
            }

            if (!response.ok) {
                resultContainer.innerHTML = '';

                showHistoryMessage(
                    result?.message || 'Customer not found or unable to load order history.',
                    'error'
                );

                return;
            }

            const orders =
                Array.isArray(result) ? result : [];

            if (orders.length === 0) {
                resultContainer.innerHTML = '';

                showHistoryMessage(
                    'No orders found for this email.',
                    'error'
                );

                return;
            }

            renderOrderHistory(orders);

        } catch (error) {
            console.error(error);

            resultContainer.innerHTML = '';

            showHistoryMessage(
                'Unable to connect to the Laravel server.',
                'error'
            );
        }
    }


    function renderOrderHistory(orders) {
        const resultContainer =
            document.getElementById('history-result');

        const firstOrder = orders[0];

        const customer =
            firstOrder.customer || {};

        const customerName =
            customer.name || 'Customer';

        const customerEmail =
            customer.email ||
            document
                .getElementById('history-email')
                .value
                .trim();

        window.orderHistoryData = {};

        let html = `
            <div class="history-customer">
                <strong>${escapeHtml(customerName)}</strong>
                <span>${escapeHtml(customerEmail)}</span>
            </div>

            <div class="history-table-shell">
                <table class="history-table">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Date</th>
                            <th>Products</th>
                            <th>Total</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
        `;

        orders.forEach(order => {
            const items =
                order.order_items ||
                order.orderItems ||
                [];

            const productHtml =
                items.length > 0
                    ? `
                        <ul class="history-products">
                            ${items.map(item => {
                                const product =
                                    item.product || {};

                                const productName =
                                    product.name || 'Product';

                                return `
                                    <li>
                                        ${escapeHtml(productName)}
                                        × ${Number(item.quantity || 0)}
                                    </li>
                                `;
                            }).join('')}
                        </ul>
                    `
                    : '-';

            const orderDate =
                order.created_at
                    ? new Date(order.created_at).toLocaleString()
                    : '-';

            window.orderHistoryData[order.id] = order;

            html += `
                <tr>
                    <td>#${escapeHtml(order.id)}</td>
                    <td>${escapeHtml(orderDate)}</td>
                    <td>${productHtml}</td>
                    <td class="history-total">
                        ${formatMoney(order.grand_total)}
                    </td>
                    <td>
                        <button
                            type="button"
                            class="view-bill-button"
                            onclick="viewOrderBill(${Number(order.id)})"
                        >
                            View
                        </button>
                    </td>
                </tr>
            `;
        });

        html += `
                    </tbody>
                </table>
            </div>
        `;

        resultContainer.innerHTML = html;
    }


    function viewOrderBill(orderId) {
        const order =
            window.orderHistoryData[orderId];

        if (!order) {
            return;
        }

        const customer =
            order.customer || {};

        const items =
            order.order_items ||
            order.orderItems ||
            [];

        const billContent =
            document.getElementById('bill-content');

        const itemsHtml =
            items.length > 0
                ? items.map(item => {
                    const product = item.product || {};
                    const productName = product.name || 'Product';
                    const quantity = Number(item.quantity || 0);
                    const unitPrice = Number(item.unit_price || product.price || 0);
                    const lineTotal = Number(
                        item.line_total ||
                        (unitPrice * quantity) + Number(item.line_tax || 0)
                    );

                    return `
                        <tr>
                            <td>${escapeHtml(productName)}</td>
                            <td>${quantity}</td>
                            <td>${formatMoney(unitPrice)}</td>
                            <td>${formatMoney(lineTotal)}</td>
                        </tr>
                    `;
                }).join('')
                : `
                    <tr>
                        <td colspan="4">No products found.</td>
                    </tr>
                `;

        billContent.innerHTML = `
            <div class="bill-customer">
                <strong>${escapeHtml(customer.name || 'Customer')}</strong>
                <span>${escapeHtml(customer.email || '')}</span>
            </div>

            <table class="bill-items">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    ${itemsHtml}
                </tbody>
            </table>

            <div class="bill-summary">
                <div class="bill-summary-row">
                    <span>Subtotal</span>
                    <span>${formatMoney(order.subtotal)}</span>
                </div>
                <div class="bill-summary-row">
                    <span>Tax</span>
                    <span>${formatMoney(order.tax)}</span>
                </div>
                <div class="bill-summary-row total">
                    <span>Grand Total</span>
                    <span>${formatMoney(order.grand_total)}</span>
                </div>
            </div>
        `;

        const modal =
            document.getElementById('bill-modal');

        modal.classList.add('open');
        modal.setAttribute('aria-hidden', 'false');
    }


    function closeOrderBill() {
        const modal =
            document.getElementById('bill-modal');

        modal.classList.remove('open');
        modal.setAttribute('aria-hidden', 'true');

        document.getElementById('bill-content').innerHTML = '';
    }


    document
        .getElementById('history-button')
        .addEventListener(
            'click',
            openHistory
        );


    document
        .getElementById('history-close-button')
        .addEventListener(
            'click',
            closeHistory
        );


    document
        .getElementById('bill-close-button')
        .addEventListener(
            'click',
            closeOrderBill
        );


    document
        .getElementById('bill-modal')
        .addEventListener(
            'click',
            event => {
                if (event.target.id === 'bill-modal') {
                    closeOrderBill();
                }
            }
        );


    document
        .getElementById('history-overlay')
        .addEventListener(
            'click',
            closeHistory
        );


    document
        .getElementById('history-search-button')
        .addEventListener(
            'click',
            searchOrderHistory
        );


    document
        .getElementById('history-email')
        .addEventListener(
            'keydown',
            event => {
                if (event.key === 'Enter') {
                    searchOrderHistory();
                }
            }
        );


    /*
     * Event listeners
     */

    document
        .getElementById('add-product-button')
        .addEventListener(
            'click',
            addProductRow
        );


    document
        .getElementById('amount-given')
        .addEventListener(
            'input',
            calculateBalance
        );


    document
        .getElementById('customer-email')
        .addEventListener(
            'blur',
            findCustomer
        );


    document
        .getElementById('generate-bill-button')
        .addEventListener(
            'click',
            createOrder
        );


    /*
     * Initial page load
     */
    loadProducts();

    loadLowStockProducts();

</script>

</body>
</html>

