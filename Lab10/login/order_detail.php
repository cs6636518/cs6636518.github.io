 <?php
    include "connect.php";
    function OrderUser($pdo, $username)
    {
        echo "<strong>" . "ออเดอร์ทั้งหมดของ " . htmlspecialchars($username) . "</strong>" . "<br>";
        $stmt = $pdo->prepare(
            "SELECT o.ord_id, SUM(p.price*t.quantity) AS total_price ,o.ord_date,o.status
            FROM orders o
            JOIN member m ON m.username = o.username 
            JOIN item t ON t.ord_id = o.ord_id
            JOIN product p ON p.pid = t.pid  
            WHERE m.username = :username
            GROUP BY o.ord_id"
        );
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        echo "<table border='1'>";
        echo "<tr>
        <th>รหัสออเดอร์</th>
        <th>ราคารวม</th>
        <th>วันที่สั่งซื้อ</th>
        <th>สถานะการชำระ</th>
             </tr>";

        while ($row = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>" . $row["ord_id"] . "</td>";
            echo "<td>" . $row["total_price"] . " บาท</td>";
            echo "<td>" . $row["ord_date"] . "</td>";
            echo "<td>" . $row["status"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
    ?>