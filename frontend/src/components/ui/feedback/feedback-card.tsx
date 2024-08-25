import { Feedback } from "@/types/definitions";
import { UserCircleIcon } from "lucide-react";
import { Card, CardContent } from "../card";

export default function FeedbackCard({ id, feedback, rating }: Feedback) {
  return (
    <Card>
      <CardContent className="flex justify-start items-center p-4 gap-2">
        <div>
          <UserCircleIcon></UserCircleIcon>
        </div>
        <div>
          <p>{feedback}</p>
        </div>
      </CardContent>
    </Card>
  );
}
