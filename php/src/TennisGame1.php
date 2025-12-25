<?php

declare(strict_types=1);

namespace TennisGame;

class TennisGame1 implements TennisGame
{
    private int $m_score1 = 0;

    private int $m_score2 = 0;

    public function __construct()
    {
    }

    public function wonPoint(string $playerName): void
    {
        $playerName === 'player1' ? $this->m_score1++ : $this->m_score2++;
    }

    public function getScore(): string
    {
        $score = '';

        //in case of equity we don't have to proceed
        if ($this->m_score1 === $this->m_score2)
            return $this->getEquialityConditionScore($this->m_score1);

        //case where any score is 4 or more
        if ($this->m_score1 >= 4 || $this->m_score2 >= 4)
            return $this->getAdvantageOrWinScore($this->m_score1, $this->m_score2);


        for ($i = 1; $i < 3; $i++) {
            if ($i === 1) {
                $tempScore = $this->m_score1;
            } else {
                $score .= '-';
                $tempScore = $this->m_score2;
            }
            switch ($tempScore) {
                case 0:
                    $score .= 'Love';
                    break;
                case 1:
                    $score .= 'Fifteen';
                    break;
                case 2:
                    $score .= 'Thirty';
                    break;
                case 3:
                    $score .= 'Forty';
                    break;
            }
        }

        return $score;
    }

    protected function getEquialityConditionScore($score): string
    {
        return match ($score) {
            0 => 'Love-All',
            1 => 'Fifteen-All',
            2 => 'Thirty-All',
            default => 'Deuce',
        };
    }

    protected function getAdvantageOrWinScore($m_score1, $m_score2): string
    {
        return match ($minusResult = $m_score1 - $m_score2) {
            1 => 'Advantage player1',
            -1 => 'Advantage player2',
            default => ($minusResult >= 2) ? 'Win for player1' : 'Win for player2',
        };

    }
}
