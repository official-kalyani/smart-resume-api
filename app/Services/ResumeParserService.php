<?php

namespace App\Services;

class ResumeParserService
{
    public function extract($text)
    {
        return [
            'name'       => $this->extractName($text),
            'email'      => $this->extractEmail($text),
            'phone'      => $this->extractPhone($text),
            'education'  => $this->extractEducation($text),
            'skills'     => $this->extractSkills($text),
            'experience' => $this->extractExperience($text),
        ];
    }

    protected function extractName($text)
    {
      // Try to capture the first line as a fallback name
    $lines = explode("\n", trim($text));
    if (!empty($lines)) {
        $firstLine = trim($lines[0]);
        if (strlen($firstLine) <= 50) { // Optional check for name length
            return $firstLine;
        }
    }

    // Otherwise, return null
    return null;
    }
    // protected function extractName($text)
    // {
    //     // Dummy logic – improve as needed
    //     if (preg_match('/Name[:\s]*([A-Z][a-z]+(?:\s[A-Z][a-z]+)+)/', $text, $matches)) {
    //         return $matches[1];
    //     }
    //     return null;
    // }

    protected function extractEmail($text)
    {
        preg_match('/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}/i', $text, $matches);
        return $matches[0] ?? null;
    }

    protected function extractPhone($text)
    {
        preg_match('/(\+91[\-\s]?)?[0]?(91)?[789]\d{9}/', $text, $matches);
        return $matches[0] ?? null;
    }

    protected function extractEducation($text)
    {
        preg_match_all('/(Bachelor|Master|B\.Tech|M\.Tech|BSc|MSc)[^.,\n]*/i', $text, $matches);
        return $matches[0] ?? [];
    }

    protected function extractSkills($text)
    {
        if (preg_match('/Skills\s*[:\-]?\s*(.*)/i', $text, $matches)) {
            return preg_split('/[,|•\-]/', $matches[1]);
        }
        return [];
    }

    protected function extractExperience($text)
    {
        preg_match_all('/(Worked at|Experience|Position)[^.,\n]*/i', $text, $matches);
        return $matches[0] ?? [];
    }
}
