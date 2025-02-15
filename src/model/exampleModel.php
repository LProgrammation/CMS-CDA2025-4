<?php
/**
 * Summary of exampleModel
 */
class exampleModel
{
    /**
     * Function to get something information
     * @return true
     */
    public function getExampleInfo(): bool
    {
        $pdo = BDD::getInstance();
        // Insert sql request to get info about something like users or others things
        return true;
    }

    public function getExampleInfoById($id): bool
    {

        // Insert sql request to get info about something like users or others things by id
        return true;
    }




}