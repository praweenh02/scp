<?php
if (!empty($_SESSION['user_id']) && !empty($admin_id)) {
  $stmt = $db->prepare("SELECT permission FROM permission_master
        WHERE user_id = :uid AND admin_id = :admin_id
        LIMIT 1
    ");
  $stmt->execute([
    ':uid' => $_SESSION['user_id'],
    ':admin_id' => $admin_id
  ]);

  $result_1 = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($result_1 && !empty($result_1['permission'])) {
    $permitmodule = explode(',', $result_1['permission']);
  } else {
    $permitmodule = []; // empty array if no permissions
  }
} else {
  $permitmodule = []; // fallback
}
?>
<aside class="app-sidebar">

    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="upload/avatar/user.png" width="48"
            height="48">


        <div>
            <p class="app-sidebar__user-name" style="text-transform:capitalize;"><?= $_SESSION['name']; ?></p>
            <p class="app-sidebar__user-designation"><?php if (
                                                  $_SESSION['role_id'] == 1
                                                ) {
                                                  echo 'Administrator';
                                                } elseif ($_SESSION['role_id'] == 2) {
                                                  echo 'User';
                                                } ?></p>
        </div>
    </div>
    <?php
  $currentPage = basename($_SERVER['PHP_SELF']); // example: sales-invoice.php
  ?>
    <?php if ($_SESSION['role_id'] == 2) { ?>
    <ul class="app-menu">
        <li><a class="app-menu__item <?= ($currentPage == 'dashboard') ? 'active' : '' ?>" href="dashboard"><i
                    class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <?php
      if (in_array('purachase', $permitmodule) && $row['role'] == 2) { ?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                    class="app-menu__icon fa fa-cart-plus"></i><span class="app-menu__label">Purchase</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="create-customer"><i class=" icon fa fa-users"></i> Add New</a></li>
                <li><a class="treeview-item" href="vendor.php"><i class=" icon fa fa-users"></i> Vendor</a></li>
                <li><a class="treeview-item" href="customer"><i class="icon fa fa-users"></i> Customer</a></li>
                <li><a class="treeview-item" href="product" rel="noopener"><i class="icon fa fa-sitemap"></i>
                        Product</a>
                </li>


            </ul>
        </li>
        <?php }
      if (in_array('sales', $permitmodule) && $row['role'] == 2) { ?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                    class="app-menu__icon fa fa-cart-plus"></i><span class="app-menu__label">Sales</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">

                <li><a class="treeview-item" href="sales-invoice"><i class="icon fa fa-circle-o"></i> Sales invoice</a>
                </li>
                <li><a class="treeview-item" href="sales-order-list"><i class="icon fa fa-circle-o"></i>Sales order
                        list</a></li>
                <li><a class="treeview-item" href="sales-return"><i class="icon fa fa-circle-o"></i>Sales Return</a>
                </li>
            </ul>
        </li>
        <?php }
      if (
        in_array('bank_transction', $permitmodule) &&
        $row['role'] == 2
      ) { ?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                    class="app-menu__icon  fa  fa-credit-card-alt"></i><span class="app-menu__label">Banking &
                    Transctions</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="bank-account"><i class="icon fa fa-circle-o"></i>Bank Account</a>
                </li>
                <li><a class="treeview-item" href="bank-account-deposits"><i class="icon fa fa-circle-o"></i> Bank
                        Account Deposits</a></li>
                <li><a class="treeview-item" href="bank-account-transfers"><i class="icon fa fa-circle-o"></i> Bank
                        Account Transfers</a></li>
                <li><a class="treeview-item" href="transactions"><i class="icon fa fa-circle-o"></i> Transactions</a>
                </li>
            </ul>
        </li>
        <?php }
      if (in_array('expenses', $permitmodule) && $row['role'] == 2) { ?>
        <li><a class="app-menu__item" href="expense"><i class="app-menu__icon fa fa-gift"></i><span
                    class="app-menu__label">Expenses</span></a></li>
        <?php }
      if (in_array('gst_reports', $permitmodule) && $row['role'] == 2) { ?>
        <li><a class="app-menu__item" href="gst-report"><i class="app-menu__icon fa fa-line-chart"></i><span
                    class="app-menu__label">GST Reports</span></a>
        </li>
        <?php }
      if (in_array('reports', $permitmodule) && $row['role'] == 2) { ?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                    class="app-menu__icon fa fa-bar-chart"></i><span class="app-menu__label">Reports</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="inventory-stock-on-hand"><i class="icon fa fa-circle-o"></i>
                        Inventory Stock on Hand</a></li>
                <li><a class="treeview-item" href="purchase-report"><i class="icon fa fa-circle-o"></i>Purchase
                        Report</a></li>
                <li><a class="treeview-item" href="sales-report"><i class="icon fa fa-circle-o"></i> Sales Report </a>
                </li>

                <li><a class="treeview-item" href="expense-report"><i class="icon fa fa-circle-o"></i> Expense Report
                    </a></li>
                <li><a class="treeview-item" href="income-report"><i class="icon fa fa-circle-o"></i> Income Report </a>
                </li>
                <li><a class="treeview-item" href="income-vs-expense-report"><i class="icon fa fa-circle-o"></i> Income
                        V/S Expense Report </a></li>
                <li><a class="treeview-item" href="return-oder-report"><i class="icon fa fa-circle-o"></i> Return Order
                        Reports </a></li>
            </ul>
        </li>

        <?php }
      if ($row['role'] == 1) { ?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                    class="app-menu__icon fa fal fa-cogs"></i><span class="app-menu__label">Setting</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="setting"><i class="icon fa fa-circle-o"></i> Company Details</a></li>
                <li><a class="treeview-item" href="general-setting?1"><i class="icon fa fa-circle-o"></i> General
                        Settings</a></li>
                <li><a class="treeview-item" href="finance-setting?1"><i class="icon fa fa-circle-o"></i> Finance</a>
                </li>
                <li>
                    <a class="treeview-item" href="print-barcode"><i class="icon fa fa-circle-o"></i> Print
                        Barcode/Label</a>
                </li>

            </ul>
        </li>
        <?php }
      ?>
    </ul>
    <?php } elseif ($_SESSION['role_id'] == 1) { ?>
    <ul class="app-menu">
        <li><a class="app-menu__item <?= ($currentPage == 'dashboard.php') ? 'active' : '' ?>" href="dashboard"><i
                    class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <?php
      $salesPages = ['print-barcode.php', 'product.php'];
      $isSalesActive = in_array($currentPage, $salesPages);
      ?>
        <li class="treeview <?= $isSalesActive ? 'is-expanded' : '' ?>"><a class="app-menu__item" href="#"
                data-toggle="treeview"><i class="app-menu__icon fa fa-list"></i><span
                    class="app-menu__label">Catalog</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu" style="<?= $isSalesActive ? 'display:block;' : '' ?>">
                <li>
                    <a class="treeview-item <?= ($currentPage == 'product.php') ? 'active' : '' ?>" href="product"
                        rel="noopener"><i class="icon fa fa-circle-o"></i> Product</a>
                </li>

                <li>
                    <a class="treeview-item <?= ($currentPage == 'print-barcode.php') ? 'active' : '' ?>"
                        href="print-barcode">
                        <i class="icon fa fa-circle-o"></i> Print Barcode/Label
                    </a>
                </li>
            </ul>
        </li>
        <?php
      $contactsPages = ['vendors.php', 'customer.php', 'staff.php', 'create-customer.php'];
      $isSalesActive = in_array($currentPage, $contactsPages);
      ?>
        <li class="treeview <?= $isSalesActive ? 'is-expanded' : '' ?>"><a class=" app-menu__item" href="#"
                data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span
                    class="app-menu__label">Contacts</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu" style="<?= $isSalesActive ? 'display:block;' : '' ?>">


                <li><a class="treeview-item <?= ($currentPage == 'customer.php') ? 'active' : '' ?>" href="customer"><i
                            class="icon fa fa-circle-o"></i> Customer</a></li>
                <li><a class="treeview-item <?= ($currentPage == 'vendors.php') ? 'active' : '' ?>" href="vendors"><i
                            class=" icon fa fa-circle-o"></i> Vendor</a></li>
                <li><a class="treeview-item <?= ($currentPage == 'staff.php') ? 'active' : '' ?>" href="staff"><i
                            class="icon fa fa-circle-o"></i> Staff</a></li>
            </ul>
        </li>
        <?php
      $purchasePages = ['purchase-return.php', 'purchase-list.php', 'purchase.php'];
      $isSalesActive = in_array($currentPage, $purchasePages);
      ?>

        <li class="treeview <?= $isSalesActive ? 'is-expanded' : '' ?>"><a class="app-menu__item" href="#"
                data-toggle="treeview"><i class="app-menu__icon fa fa-cart-plus"></i><span
                    class="app-menu__label">Purchase</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu" style="<?= $isSalesActive ? 'display:block;' : '' ?>">


                <li><a class=" treeview-item  <?= ($currentPage == 'purchase.php') ? 'active' : '' ?>" href="purchase"
                        rel="noopener"><i class="icon fa fa-circle-o"></i> Purchase order</a>
                </li>
                <li><a class="treeview-item <?= ($currentPage == 'purchase-list.php') ? 'active' : '' ?>"
                        href="purchase-list" rel="noopener"><i class="icon fa fa-circle-o"></i> Purchase List</a></li>
                <li><a class="treeview-item <?= ($currentPage == 'purchase-return.php') ? 'active' : '' ?>"
                        href="purchase-return" rel="noopener"><i class="icon fa fa-circle-o"></i> Purchase Return</a>
                </li>

            </ul>
        </li>
        <?php
      $salesPages = ['sales-invoice.php', 'sales-order-list.php', 'sales-return.php'];
      $isSalesActive = in_array($currentPage, $salesPages);
      ?>
        <li class="treeview <?= $isSalesActive ? 'is-expanded' : '' ?>"><a class="app-menu__item" href="#"
                data-toggle="treeview"><i class="app-menu__icon fa fa-cart-plus"></i><span
                    class="app-menu__label">Sales</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">

                <li><a class="treeview-item <?= ($currentPage == 'sales-invoice.php') ? 'active' : '' ?>"
                        href="sales-invoice"><i class="icon fa fa-circle-o"></i> Sales invoice</a></li>
                <li><a class="treeview-item  <?= ($currentPage == 'sales-order-list.php') ? 'active' : '' ?>"
                        href="sales-order-list"><i class="icon fa fa-circle-o"></i>Sales order list</a></li>
                <li><a class="treeview-item <?= ($currentPage == 'sales-return.php') ? 'active' : '' ?>"
                        href="sales-return"><i class="icon fa fa-circle-o"></i>Sales Return</a></li>
            </ul>
        </li>
        <?php
      $salesPages = ['bank-account.php', 'bank-deposits.php', 'bank-account-transfers.php', 'transactions.php', 'payment.php'];
      $isSalesActive = in_array($currentPage, $salesPages);
      ?>
        <li class="treeview <?= $isSalesActive ? 'is-expanded' : '' ?>"><a class="app-menu__item" href="#"
                data-toggle="treeview"><i class="app-menu__icon  fa  fa-credit-card-alt"></i><span
                    class="app-menu__label">Banking & Transctions</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item <?= ($currentPage == 'bank-account.php') ? 'active' : '' ?>"
                        href="bank-account"><i class="icon fa fa-circle-o"></i>Bank Account</a></li>
                <li><a class="treeview-item <?= ($currentPage == 'bank-deposits.php') ? 'active' : '' ?>"
                        href="bank-deposits"><i class="icon fa fa-circle-o"></i> Bank Deposits</a></li>
                <li><a class="treeview-item <?= ($currentPage == 'payment.php') ? 'active' : '' ?>" href="payment"><i
                            class="icon fa fa-circle-o"></i>Payment</a></li>
                <li><a class="treeview-item <?= ($currentPage == 'bank-account-transfers.php') ? 'active' : '' ?>"
                        href="bank-account-transfers"><i class="icon fa fa-circle-o"></i> Bank Transfers</a></li>
                <li><a class="treeview-item <?= ($currentPage == 'transactions.php') ? 'active' : '' ?>"
                        href="transactions"><i class="icon fa fa-circle-o"></i> View Transactions</a></li>
            </ul>
        </li>

        <li><a class="app-menu__item <?= ($currentPage == 'expense.php') ? 'active' : '' ?>" href="expense"><i
                    class="app-menu__icon fa fa-gift"></i><span class="app-menu__label">Expenses</span></a></li>

        <!-- <li><a class="app-menu__item" href="gst-report"><i class="app-menu__icon fa fa-line-chart"></i><span class="app-menu__label">GST Reports</span></a>
          </li> -->
        <?php
      $currentPage = basename($_SERVER['PHP_SELF']);
      $reportPages = [
        'inventory-stock-on-hand.php',
        'purchase-report.php',
        'sales-report.php',
        'expense-report.php',
        'income-report.php',
        'income-vs-expense-report.php',
        'return-oder-report.php'
      ];

      $isReportActive = in_array($currentPage, $reportPages);
      ?>
        <li class="treeview <?= $isReportActive ? 'is-expanded' : '' ?>">
            <a class="app-menu__item <?= $isReportActive ? 'active' : '' ?>" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-bar-chart"></i>
                <span class="app-menu__label">Reports</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>

            <ul class="treeview-menu" style="<?= $isReportActive ? 'display:block;' : '' ?>">

                <li>
                    <a class="treeview-item <?= ($currentPage == 'inventory-stock-on-hand.php') ? 'active' : '' ?>"
                        href="inventory-stock-on-hand">
                        <i class="icon fa fa-circle-o"></i> Inventory Stock on Hand
                    </a>
                </li>

                <li>
                    <a class="treeview-item <?= ($currentPage == 'purchase-report.php') ? 'active' : '' ?>"
                        href="purchase-report">
                        <i class="icon fa fa-circle-o"></i> Purchase Report
                    </a>
                </li>

                <li>
                    <a class="treeview-item <?= ($currentPage == 'sales-report.php') ? 'active' : '' ?>"
                        href="sales-report">
                        <i class="icon fa fa-circle-o"></i> Sales Report
                    </a>
                </li>

                <li>
                    <a class="treeview-item <?= ($currentPage == 'expense-report.php') ? 'active' : '' ?>"
                        href="expense-report">
                        <i class="icon fa fa-circle-o"></i> Expense Report
                    </a>
                </li>

                <li>
                    <a class="treeview-item <?= ($currentPage == 'income-report.php') ? 'active' : '' ?>"
                        href="income-report">
                        <i class="icon fa fa-circle-o"></i> Income Report
                    </a>
                </li>

                <li>
                    <a class="treeview-item <?= ($currentPage == 'income-vs-expense-report.php') ? 'active' : '' ?>"
                        href="income-vs-expense-report">
                        <i class="icon fa fa-circle-o"></i> Income V/S Expense Report
                    </a>
                </li>

                <li>
                    <a class="treeview-item <?= ($currentPage == 'return-oder-report.php') ? 'active' : '' ?>"
                        href="return-oder-report">
                        <i class="icon fa fa-circle-o"></i> Return Order Reports
                    </a>
                </li>
                <li>

                </li>

            </ul>
        </li>

        <?php
      $currentPage = basename($_SERVER['PHP_SELF']);

      $settingPages = [
        'setting.php',
        'general-setting.php',
        'finance-setting.php',
        'print-barcode.php'
      ];

      $isSettingActive = in_array($currentPage, $settingPages);
      ?>
        <li class="treeview <?= $isSettingActive ? 'is-expanded' : '' ?>">
            <a class="app-menu__item <?= $isSettingActive ? 'active' : '' ?>" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-cogs"></i>
                <span class="app-menu__label">Setting</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>

            <ul class="treeview-menu" style="<?= $isSettingActive ? 'display:block;' : '' ?>">

                <li>
                    <a class="treeview-item <?= ($currentPage == 'setting.php') ? 'active' : '' ?>" href="setting">
                        <i class="icon fa fa-circle-o"></i> Company Details
                    </a>
                </li>

                <li>
                    <a class="treeview-item <?= ($currentPage == 'general-setting.php') ? 'active' : '' ?>"
                        href="general-setting?1">
                        <i class="icon fa fa-circle-o"></i> General Settings
                    </a>
                </li>

                <li>
                    <a class="treeview-item <?= ($currentPage == 'finance-setting.php') ? 'active' : '' ?>"
                        href="finance-setting?1">
                        <i class="icon fa fa-circle-o"></i> Finance
                    </a>
                </li>


            </ul>
        </li>
        <li>
        <li><a class="app-menu__item " href="signout"><i class="app-menu__icon fa fa-sign-out fa-lg"></i><span
                    class="app-menu__label">Logout</span></a></li>
        </li>


    </ul>
    <?php } ?>
</aside>