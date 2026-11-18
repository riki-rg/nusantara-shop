---
type: community
cohesion: 0.07
members: 54
---

# README.md: AdminOrderController.php

**Cohesion:** 0.07 - loosely connected
**Members:** 54 nodes

## Members
- [[dot-__construct()]] - code - app/Http/Controllers/PaymentController.php
- [[dot-__construct()_1]] - code - app/Services/MidtransService.php
- [[dot-authorizeOrder()]] - code - app/Http/Controllers/OrderController.php
- [[dot-confirm()]] - code - app/Http/Controllers/OrderController.php
- [[dot-createSnapToken()]] - code - app/Services/MidtransService.php
- [[dot-index()_1]] - code - app/Http/Controllers/Admin/AdminOrderController.php
- [[dot-index()_4]] - code - app/Http/Controllers/OrderController.php
- [[dot-isConfigured()]] - code - app/Services/MidtransService.php
- [[dot-orderCreated()]] - code - app/Services/NotificationService.php
- [[dot-orderStatusChanged()]] - code - app/Services/NotificationService.php
- [[dot-pay()]] - code - app/Http/Controllers/PaymentController.php
- [[dot-sendTelegram()]] - code - app/Services/NotificationService.php
- [[dot-sendWhatsApp()]] - code - app/Services/NotificationService.php
- [[dot-show()_1]] - code - app/Http/Controllers/OrderController.php
- [[dot-statusLabel()]] - code - app/Models/Order.php
- [[dot-totalInRupiah()]] - code - app/Models/Order.php
- [[dot-updateStatus()]] - code - app/Http/Controllers/Admin/AdminOrderController.php
- [[dot-verifyTransaction()]] - code - app/Services/MidtransService.php
- [[dot-webhook()]] - code - app/Http/Controllers/PaymentController.php
- [[Admin Panel (admin, is_admin = true)]] - document - README.md
- [[Admin Product Image Upload (max 2MB, auto-cleanup)]] - document - README.md
- [[AdminOrderController]] - code - app/Http/Controllers/Admin/AdminOrderController.php
- [[AdminOrderController.php]] - code - app/Http/Controllers/Admin/AdminOrderController.php
- [[Automated Multi-Channel Notifications (Email, WA, Telegram)]] - document - README.md
- [[Checkout & Auto-Invoice (INV-YYYYMMDD-XXXXXX)]] - document - README.md
- [[Fonnte WhatsApp Notification API]] - document - README.md
- [[Graceful Optional .env Service Configuration]] - document - README.md
- [[IlluminateSupportFacadesHttp]] - code
- [[IlluminateSupportFacadesLog]] - code
- [[IlluminateSupportFacadesMail]] - code
- [[IlluminateSupportFacadesRoute]] - code
- [[Midtrans Snap Payment Gateway]] - document - README.md
- [[Midtrans Webhook (SHA-512 Verification & API Re-check)]] - document - README.md
- [[MidtransService]] - code - app/Services/MidtransService.php
- [[MidtransService.php]] - code - app/Services/MidtransService.php
- [[MidtransConfig]] - code
- [[MidtransSnap]] - code
- [[NotificationService]] - code - app/Services/NotificationService.php
- [[NotificationService.php]] - code - app/Services/NotificationService.php
- [[Order]] - code - app/Models/Order.php
- [[Order Status Lifecycle (pending to completedcancelled)]] - document - README.md
- [[OrderController]] - code - app/Http/Controllers/OrderController.php
- [[OrderController.php]] - code - app/Http/Controllers/OrderController.php
- [[PaymentController]] - code - app/Http/Controllers/PaymentController.php
- [[PaymentController.php]] - code - app/Http/Controllers/PaymentController.php
- [[Telegram Bot Notification API]] - document - README.md
- [[admin.php]] - code - routes/admin.php
- [[services.fonnte.php]] - code - config/services.fonnte.php
- [[services.midtrans.php]] - code - config/services.midtrans.php
- [[services.telegram.php]] - code - config/services.telegram.php
- [[{closure1}()]] - code - app/Http/Controllers/Admin/AdminOrderController.php
- [[{closure1}()_7]] - code - app/Services/MidtransService.php
- [[{closure1}()_8]] - code - app/Services/NotificationService.php
- [[{closure1}()_21]] - code - routes/admin.php

## Live Query (requires Dataview plugin)

```dataview
TABLE source_file, type FROM #community/READMEmd_AdminOrderControllerphp
SORT file.name ASC
```

## Connections to other communities
- 20 edges to [[_COMMUNITY_AdminProductController.php AdminDashboardContro]]
- 4 edges to [[_COMMUNITY_Module ReviewController.php]]
- 3 edges to [[_COMMUNITY_Module CheckoutController.php]]
- 2 edges to [[_COMMUNITY_Product.php Order.php]]
- 2 edges to [[_COMMUNITY_OrderItem.php Category.php]]
- 2 edges to [[_COMMUNITY_README.md Laravel 13.40 & PHP 8.3 Stack]]

## Top bridge nodes
- [[Order]] - degree 25, connects to 5 communities
- [[OrderController]] - degree 8, connects to 2 communities
- [[PaymentController]] - degree 8, connects to 2 communities
- [[Admin Panel (admin, is_admin = true)]] - degree 7, connects to 2 communities
- [[Checkout & Auto-Invoice (INV-YYYYMMDD-XXXXXX)]] - degree 5, connects to 2 communities