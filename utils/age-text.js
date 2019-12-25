import {differenceInYears, parse} from 'date-fns';

const ageText = (birthday) => {
    const now = new Date();
    const parsedBirthday = parse(birthday, 'yyyy-MM-dd', now);
    return differenceInYears(now, parsedBirthday);
}

export default ageText;
