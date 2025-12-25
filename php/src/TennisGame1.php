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
        //in case of equity we don't have to proceed
        if ($this->m_score1 === $this->m_score2)
            return $this->getEquialityConditionScore($this->m_score1);

        //case where any score is 4 or more
        if ($this->m_score1 >= 4 || $this->m_score2 >= 4)
            return $this->getAdvantageOrWinScore($this->m_score1, $this->m_score2);

        //case where the score is 3 or less
        return $this->getBoardScore($this->m_score1, $this->m_score2);
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

    protected function getScoreStringValue($tempScore): string
    {
        return match ($tempScore) {
            0 => 'Love',
            1 => 'Fifteen',
            2 => 'Thirty',
            3 => 'Forty',
        };
    }

    protected function getBoardScore($m_score1, $m_score2): string
    {
        return $this->getScoreStringValue($m_score1) . '-' . $this->getScoreStringValue($m_score2);
    }
}
