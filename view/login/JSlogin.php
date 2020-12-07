<?php
if (!session_id()) {
    session_start();
};
if (isset($_SESSION['user_status'])) {
    echo json_encode($_SESSION['user_status']['Status']);
} else {
    echo json_encode('-1');
}
