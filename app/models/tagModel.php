<?php
class tagModel {
    private $tag_id;
    private $tag;
    private $ticket_id;
    private $conn;

    function __set($property, $value)
    {
        $this->$property = $value;
    }

    function __get($property)
    {
        return $this->$property;
    }

    function insertTag($conn, $ticket_id, $tag_id) {
        $sql = "INSERT INTO tag_ticket (ticket_id, tag_id) VALUES ($ticket_id, $tag_id)";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_execute($stmt);
    }

    function updateTag($conn, $ticket_id, $tag_id) {
        $sql = "UPDATE tag_ticket SET ticket_id='$ticket_id', tag_id='$tag_id'";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_execute($stmt);
    }

    function getAllTags()
    {
        $sql = "SELECT * FROM tag";
        $res = $this->conn->query($sql);
        $tagData = [];
        while ($row = $res->fetch_assoc()) {
            $tagData[] = $row;
        }
        return $tagData;
    }

    function getArticleTags() {
        $sql = "SELECT tag.* FROM tag_ticket
        JOIN tag ON tag_ticket.tag_id = tag.tag_id 
        WHERE ticket_id = $this->ticket_id";

        $res = $this->conn->query($sql);
        $tagData = [];
        while ($row = $res->fetch_assoc()) {
            $tagData[] = $row;
        }
        return $tagData;
    }
}